<?php

namespace App\Usecases;

use App\Enum\Models\ShopModel;
use App\Repositories\CreateImagesOfShopRepository;
use App\Repositories\GetShopRepository;
use App\Repositories\UpdateImageOfShopRepository;
use App\Repositories\UpdateShopRepository;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UpdateShopUsecase
{
    private GetShopRepository $_getShopRepository;

    private UpdateShopRepository $_updateShopRepository;

    private UpdateImageOfShopRepository $_updateImageOfShopRepository;

    /**
     * Create a new usecase instance.
     *
     * @return void
     */
    public function __construct(
        GetShopRepository $getShopRepository,
        UpdateShopRepository $updateShopRepository,
        UpdateImageOfShopRepository $updateImageOfShopRepository
    ) {
        $this->_getShopRepository = $getShopRepository;
        $this->_updateShopRepository = $updateShopRepository;
        $this->_updateImageOfShopRepository = $updateImageOfShopRepository;
    }

    /**
     * invoke
     *
     * @return void
     */
    public function invoke(
        int $id,
        array $inputs
    ): array {
        DB::beginTransaction();

        try {
            $this->_updateShopRepository->invoke($id, $inputs);

            $this->_updateImageOfShopRepository->invoke($id, $this->get_image_links($inputs));

            $shop = $this->_getShopRepository->invoke($id, false);

            DB::commit();
            Cache::flush();

            return $shop;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function get_image_links(array $inputs): array
    {
        $inputImageLink = Arr::get($inputs, ShopModel::image_link, null);
        $inputMenuImageLinks = Arr::get($inputs, ShopModel::menu_image_link, null);
        $inputAppearanceImageLinks = Arr::get($inputs, ShopModel::appearance_image_link, null);
        $inputSubImageLinks = Arr::get($inputs, ShopModel::sub_image_link, null);

        $imageLinks = [];
        // ImageLink
        if ($inputImageLink) {
            $imageLinks[] = [
                CreateImagesOfShopRepository::url            => $inputImageLink,
                CreateImagesOfShopRepository::imageable_name => ShopModel::image_link,
            ];
        }

        if ($inputMenuImageLinks) {
            foreach ($inputMenuImageLinks as $_inputImageLink) {
                $imageLinks[] = [
                    CreateImagesOfShopRepository::url            => $_inputImageLink,
                    CreateImagesOfShopRepository::imageable_name => ShopModel::menu_image_link,
                ];
            }
        }

        if ($inputAppearanceImageLinks) {
            foreach ($inputAppearanceImageLinks as $_inputImageLink) {
                $imageLinks[] = [
                    CreateImagesOfShopRepository::url            => $_inputImageLink,
                    CreateImagesOfShopRepository::imageable_name => ShopModel::appearance_image_link,
                ];
            }
        }

        if ($inputSubImageLinks) {
            foreach ($inputSubImageLinks as $_inputImageLink) {
                $imageLinks[] = [
                    CreateImagesOfShopRepository::url            => $_inputImageLink,
                    CreateImagesOfShopRepository::imageable_name => ShopModel::sub_image_link,
                ];
            }
        }

        return $imageLinks;
    }
}
