<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\Api\BaseController;
use Symfony\Component\DomCrawler\Crawler;

class ScrapController extends BaseController
{
    public function index()
    {

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->get('https://smkpatriot-kng.sch.id/');
            $html = (string) $response->getBody();
            $website = new Crawler($html);
            $companies = $website->filter("div.rounded-0 > div.row ")->each(function ($node) {
                $full = $node->children()->eq(1)->children()->eq(0)->children()->eq(2)->children()->eq(0)->html();
                $exp = explode("-", $full);
                return [
                    "urlThumbnail" => $node->children()->eq(0)->children()->eq(0)->attr('src'),
                    "titlePost" => $node->children()->eq(1)->children()->eq(0)->children()->eq(0)->children()->eq(0)->html(),
                    "urlPostView" => $node->children()->eq(1)->children()->eq(0)->children()->eq(0)->children()->eq(0)->attr("href"),
                    "descPost" => $node->children()->eq(1)->children()->eq(0)->children()->eq(1)->html(),
                    "datePost" => trim($exp[0]),
                    "authorPost" => trim($exp[1]),
                    "viewPost" => trim($exp[2])
                ];
            });

            return $this->sendResponse($companies, "Postingan Berhasil Diambil");
        } catch (\Throwable $th) {
            return $this->sendError("Periksa Kembali URL Anda", 404);
        }
    }
}
