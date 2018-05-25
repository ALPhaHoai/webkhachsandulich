<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/admin/phanquyentheonhom/ajaxgetrightlist',
        '/admin/phanquyentheonhom/ajaxaddpermit',
        '/admin/phanquyentheonhom/ajaxremovepermit',
        '/admin/phanquyentheonhom/ajaxaddcpermit',
        '/Tour/tourlist_ajaxsearch',
        '/hotel/dangkykhachsan/them',
    ];
}
