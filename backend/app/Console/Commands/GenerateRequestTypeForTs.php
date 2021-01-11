<?php

namespace App\Console\Commands;

use App\Console\Commands\Args\ReplaceTogetherArg;
use App\Http\Requests\Api\Admin\SelectionPost\RegisterSelectionPostFormRequest;
use App\Http\Requests\Api\Admin\SelectionPost\UpdateSelectionPostFormRequest;
use App\Http\Requests\Api\Admin\Shop\RegisterShopFormRequest;
use App\Http\Requests\Api\Admin\Shop\UpdateShopFormRequest;
use App\Http\Requests\Api\Admin\ShopMenu\RegisterShopMenuFormRequest;
use App\Http\Requests\Api\Admin\ShopMenu\UpdateShopMenuFormRequest;
use Illuminate\Console\Command;
use ReflectionClass;

class GenerateRequestTypeForTs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:request';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Form Requestからtypescriptのtypeを生成する';

    /**
     * @var string[]
     */
    private array $requestClasses = [];

    private string $stubDataForMain;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
        $this->requestClasses = [
            RegisterSelectionPostFormRequest::class,
            UpdateSelectionPostFormRequest::class,
            RegisterShopFormRequest::class,
            UpdateShopFormRequest::class,
            RegisterShopMenuFormRequest::class,
            UpdateShopMenuFormRequest::class,
        ];
    }

    private function init()
    {
        /** stubの取得 */
        $this->stubDataForMain = file_get_contents($this->getStubPath());
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach ($this->requestClasses as $class) {
            $this->generateRequestUsecase($class);
        }
    }

    private function generateRequestUsecase(string $class)
    {
        $reflectionClass = new ReflectionClass($class);
        $className = $reflectionClass->getShortName();

        $requestBodyObject = '';
        $validationObject = '';

        $ruleFunction = $reflectionClass->getMethod('rules');
        /**
         * rule関数の実行
         * @var array{(string|array)} $rulesData
         */
        $rulesData = $ruleFunction->invoke($reflectionClass->newInstance());
        $rulesDataWithOutAsterisk = array_filter(
            $rulesData,
            fn (string $ruleKey) => !preg_match('/\*/', $ruleKey),
            ARRAY_FILTER_USE_KEY
        );


        foreach ($rulesDataWithOutAsterisk as $key => $value) {
            /** @var array $arrVal */
            $arrVal = is_string($value)
                ? explode('|', str_replace(' ', '', $value))
                : $value;

            $type = $this->getTsType($arrVal);
            if ($type === 'any[]' && in_array("{$key}.*", array_keys($rulesData, true), true)) {
                $arrChildVal = $rulesData["{$key}.*"];
                $arrChildVal = is_string($arrChildVal)
                    ? explode('|', str_replace(' ', '', $arrChildVal))
                    : $arrChildVal;
                $type = $this->getTsType($arrChildVal);

                if (preg_match('/\|/', $type)) {
                    $type = "({$type})";
                }

                if ($type !== 'any[]') {
                    $type .= '[]';
                }
            }

            $operator = in_array('nullable', $arrVal) ? '?:' : ':';

            $requestBodyObject .= "    {$key}{$operator} {$type}\n";
            $validationObject .= "        {$key}?: string\n";
        }
        $requestBodyObject = substr($requestBodyObject, 0, -1);
        $validationObject = substr($validationObject, 0, -1);

        /**
         * stubの置き換え
         *
         * Classのコメントと名前を置き換え
         * 定数をkeyとvalueにする
         */
        $writableData = $this->replaceTogether(
            [
                new ReplaceTogetherArg('{{ $className }}', $className),
                new ReplaceTogetherArg('{{ $requestBodyObject }}', $requestBodyObject),
                new ReplaceTogetherArg('{{ $validationObject }}', $validationObject),
            ],
            $this->stubDataForMain
        );

        /**
         * ファイルへの書き込み
         */
        file_put_contents(
            $this->getOutputTsPath().'/'.$className.'.ts',
            $writableData
        );
    }

    /**
     * まとめて置き換える
     *
     * @param ReplaceTogetherArg[] $replaceValueObjects
     * @param string $data
     * @return string
     */
    private function replaceTogether(array $replaceValueObjects, string $data): string
    {
        $_data = $data;
        foreach ($replaceValueObjects as $replaceValueObject) {
            $_data = str_replace(
                $replaceValueObject->search,
                $replaceValueObject->replace,
                $_data
            );
        }

        return $_data;
    }

    private function getStubPath(): string
    {
        return app_path('Console/Commands/stubs/requestBodyType.ts.stub');
    }

    private function getOutputTsPath(): string
    {
        return base_path('../admin/lib/types/backend');
    }

    private function getTsType(array $ruleData): string
    {
        foreach ($ruleData as $value) {
            if (
                $value === 'string' ||
                $value === 'ip' ||
                $value === 'ipv4' ||
                $value === 'ipv6' ||
                $value === 'uuid' ||
                $value === 'url'
            ) {
                return 'string';
            }

            if ($value === 'boolean') {
                return 'boolean';
            }

            if (
                $value === 'file' ||
                $value === 'image'
            ) {
                return 'Blob|File';
            }

            if ($value === 'array') {
                return 'any[]';
            }

            if (
                $value === 'integer' ||
                $value === 'numeric' ||
                preg_match('/digits/', $value)
            ) {
                return 'number';
            }
        }

        return 'any';
    }
}
