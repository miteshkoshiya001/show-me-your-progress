<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Helper
{

    public static function getMultiLangRoute($name) {
        $routeList = [];
        foreach(self::getLocales() as $lang) {
            $routeList[$lang] = $name;
        }
        return $routeList;
    }

    public static function siteLocale()
    {        
        $locale = request()->locale ?? request()->segment(1);
        $locale = in_array($locale, self::getLocales()) ? $locale : "en";
        return $locale;
    }

    public static function getLocales() {
        return Config::get('translatable.locales', []);
    }
    
    public static function storeImage($file = null, $path = '') {
        if ($file == null) {
            return null;
        }
        $fileName = time().'-'.$file->getClientOriginalName();
        Storage::disk('public')->putFileAs($path,$file,$fileName);
        \Log::info(['store' => $path]);
        return $fileName;
    }
   
    public static function removeImage($path = '') {
        if ($path == null) {
            return null;
        }
        if (Storage::exists($path)) {
            \Log::info("Storage::exists");
            Storage::delete($path);
            return true;
        }
        return false;
    }

    public static function isActiveUrl($route = '') {
        if (strpos(request()->url(), $route) !== false) {
            return 'active';
        }
        return '';
    }

    public static function validateRequest(array $request, array $rules = [], String $redirect = '/') {
        $validator = Validator::make($request, $rules);
        $errors = (new ValidationException($validator))->errors();
        $formattedError = [];
        if (!empty($errors)) {
            foreach ($errors as $key => $error) {
                $formattedError[$key] = implode(", ", $error);
            }
        }
        return redirect()->to($redirect)
                    ->withInput(request()->input())
                    ->withErrors($errors);
    }

    public static function randomAlphabetNumberGenerate($prefix = 'SKU-') {
        $letters = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $code = $prefix;
        for ($i = 0; $i < 3; $i++) {
            $code .= $letters[rand(0, count($letters) - 1)];
        }
        $code .= str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        return $code;
    }

    public static function generateOTP($length = 0){
        $characters = '0123456789';
        $OTP = '';
        for($i = 0; $i< $length; $i++){
            $OTP .= $characters[rand(0, strlen($characters) -1)];
        }
        return $OTP;
    }
}