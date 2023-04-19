<?php

    namespace App\Traits;

    trait ImageUpload
    {
        public function storeImage($request)
        {

            $newImage = uniqid() . '-' . $request->title . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $newImage);
            return $newImage;
        }


        public function catimage($request)
        {

            $newImage = uniqid() . '-' . $request->title . '.' . $request->image->extension();
            $request->image->storeAs('public/catimage', $newImage);
            return $newImage;
        }
    }

