<?php

namespace GGPHP\Shipping\Http\Controllers\API;

use Webkul\API\Http\Controllers\Shop\Controller;
use Illuminate\Http\Response;

class TrackingController extends Controller
{
    /**
     * Contains current guard
     *
     * @var array
     */
    protected $guard;

    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    public function __construct()
    {
        $this->guard = 'api';

        $this->_config = request('_config');

        if (isset($this->_config['authorization_required']) && $this->_config['authorization_required']) {
            auth()->setDefaultDriver($this->guard);

            $this->middleware('auth:' . $this->guard);
        }
    }

    /**
     * Returns a tracking info.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $trackings = uspsTrackById([$id]);

        if (isset($trackings['status']) && !$trackings['status']) {
            return response()->json([
                'errors' => [
                    [
                        'detail' => $trackings['message'] ?? '',
                    ]
                ]
            ], 400);
        }

        return response()->json([
            'data' => $trackings,
        ]);
    }
}
