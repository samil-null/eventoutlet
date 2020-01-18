<?php


namespace App\Services;


use App\Models\Specialty;
use Illuminate\Http\Request;

class FilterBuilderService
{

    /**
     * @var OfferFilterService
     */
    private $filter;

    /**
     * @var
     */
    private $filterBuilder;

    /**
     * @var array
     */
    private $bindings = [
        'speciality_id' => [
            'filter' => 'buildSpecialities',
            'name' => 'specialities'
        ],
        'specials_offers' => [
            'filter' => 'buildSpecialsOffers',
            'name' => 'specials_offers'
        ]
    ];


    public function __construct(UserFilterService $filter)
    {
        $this->filter = $filter;
    }

    /**
     * @param string $url
     * @return array
     */
    public function create($request)
    {
        //$params = $this->parseUrl($url);
        $this->filterBuilder = $this->filter->apply($request);

        return $this->apply($request->all());
    }

    /**
     * @param $url
     * @return mixed
     */
    private function parseUrl(string $url)
    {
        $query = parse_url($url, PHP_URL_QUERY);
        parse_str($query, $params);

        return $params;
    }

    /**
     * @param $params
     * @return array
     */
    public function apply($params)
    {
        $response = [];

        foreach ($params as $param => $value ) {
            if (isset($this->bindings[$param])) {
                $binding = $this->bindings[$param];
                $response[$binding['name']] = $this->{$binding['filter']}($value);
            }
        }

        return $response;
    }

    /**
     * @param $specialities
     * @return array
     */
    private function build($specialities)
    {
        return [
            'specialities' => $specialities
        ];
    }

    /**
     * @param $active
     * @return array
     */
    private function buildSpecialities($active)
    {
        $specialities = Specialty::all();

        return [
            'selected' => $active,
            'payload' => $specialities
        ];
    }

    private function buildSpecialsOffers($value)
    {
        $builder = $this->filterBuilder;
        $builder->with('maxOfferPrice');
        $addSlashes = str_replace('?', "'?'", $builder->toSql());
        $re = vsprintf(str_replace('?', '%s', $addSlashes), $builder->getBindings());
        return [
            'price' => [
                'max' => $builder->first()->maxOfferPrice[0]->max_price,
                'min' => null
            ]
        ];
    }

}
