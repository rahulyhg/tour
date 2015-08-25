<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class ATLASService extends Job implements SelfHandling
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }

    protected function query($service, $params = [])
    {
        $params['key'] = config('tours.atlas_key');
        $params['out'] = 'json';
        $query = http_build_query($params);
        $url = 'http://'. config('tours.atlas_host') .'/productsearchservice.svc/'. $service .'?' . $query;

        return (json_decode(iconv('utf-16', 'utf-8', file_get_contents($url)), true));
    }

    public function getProduct($id)
    {
        $params['productId'] = $id;
        $params['dg'] = 'PRODUCT_WIDGET,PRODUCT_INTERNET_POINTS';

        return $this->query('product', $params);
    }

    public function getService($product_id, $id)
    {
        $params['productId'] = $product_id;
        $params['serviceId'] = $id;

        return $this->query('productservice', $params);
    }

    public function accommodations($params = [])
    {
        $params['cats'] = 'ACCOMM';

        return $this->query('products', $params);
    }

    public function topAccommodations()
    {
        return $this->query('products', [
            'cats' => 'ACCOMM',
            'size' => 12,
            'dsc' => 'false',
            'ratings' => '-1,0.5,1,1.5,2,2.5,3,3.5,4,4.5,5',
            'fl' => 'product_id,product_name,product_image,rate_from, product_classifications',
            'att' => 'ESC_TXA_MULTI|ESC_TXA_DEFAULT',
            'order' => 'rating_aaa desc,rnd'
        ]);
    }

    public function tours($params = [])
    {
        $params['cats'] = 'TOUR';

        return $this->query('products', $params);
    }

    public function topTours()
    {
        return $this->query('products', [
            'cats' => 'TOUR',
            'size' => 12,
            'dsc' => 'false',
            'ratings' => '-1,0.5,1,1.5,2,2.5,3,3.5,4,4.5,5',
            'fl' => 'product_id,product_name,product_image,rate_from, product_classifications',
            'att' => 'ESC_TXA_MULTI|ESC_TXA_DEFAULT',
            'order' => 'rating_aaa desc,rnd'
        ]);
    }

    public function attractions($params = [])
    {
        $params['cats'] = 'ATTRACTION';

        return $this->query('products', $params);
    }

    public function topAttractions()
    {
        return $this->query('products', [
            'cats' => 'ATTRACTION',
            'size' => 12,
            'dsc' => 'false',
            'ratings' => '-1,0.5,1,1.5,2,2.5,3,3.5,4,4.5,5',
            'fl' => 'product_id,product_name,product_image,rate_from, product_classifications',
            'att' => 'ESC_TXA_MULTI|ESC_TXA_DEFAULT',
            'order' => 'rating_aaa desc,rnd'
        ]);
    }

    public function events($params = [])
    {
        $params['cats'] = 'EVENT';

        return $this->query('products', $params);
    }

    public function topEvents()
    {
        return $this->query('products', [
            'cats' => 'EVENT',
            'size' => 12,
            'dsc' => 'false',
            'ratings' => '-1,0.5,1,1.5,2,2.5,3,3.5,4,4.5,5',
            'fl' => 'product_id,product_name,product_image,rate_from, product_classifications',
            'att' => 'ESC_TXA_MULTI|ESC_TXA_DEFAULT',
            'order' => 'rating_aaa desc,rnd'
        ]);
    }

    public function hires($params = [])
    {
        $params['cats'] = 'HIRE';

        return $this->query('products', $params);
    }

    public function topHires()
    {
        return $this->query('products', [
            'cats' => 'HIRE',
            'size' => 12,
            'dsc' => 'false',
            'ratings' => '-1,0.5,1,1.5,2,2.5,3,3.5,4,4.5,5',
            'fl' => 'product_id,product_name,product_image,rate_from, product_classifications',
            'att' => 'ESC_TXA_MULTI|ESC_TXA_DEFAULT',
            'order' => 'rating_aaa desc,rnd'
        ]);
    }

}
