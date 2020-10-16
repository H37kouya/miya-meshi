<?php

namespace App\Console\Commands;

use App\Repositories\CreateUser;
use App\Usecases\CreateUserUsecase;
use Illuminate\Console\Command;
use \Illuminate\Validation\ValidationException;

class GenereateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:user {name : ユーザー名}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate User Token';

    /**
     * Create User
     * @var CreateUser
     */
    private CreateUserUsecase $_createUserUsecase;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CreateUserUsecase $createUserUsecase)
    {
        parent::__construct();
        $this->_createUserUsecase = $createUserUsecase;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $this->line('start'."\n");

        try {
            $this->validate();
        } catch (ValidationException $e) {
            $this->error('validation error!');
            foreach ($e->validator->getMessageBag()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        $user = $this->_createUserUsecase->invoke($name);
        $this->line('ユーザーの生成に成功しました');
        $this->info('name: '.$user['name']);
        $this->info('token: '.$user['token']);
        $this->line("\n".'end');
        return;
    }

    /**
     * Validation
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validate()
    {
        \Validator::validate(
            array_filter($this->arguments()),
            [
                'name' => 'required|max:50|unique:users'
            ],
            [
                'name.required' => '名前の入力は必須です',
                'name.max'      => '名前は50文字以内で入力してください',
                'name.unique'   => 'そのユーザー名は使用されています',
            ]
        );
    }
}
