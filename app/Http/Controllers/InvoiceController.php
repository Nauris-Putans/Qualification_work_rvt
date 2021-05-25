<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class InvoiceController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(Request $request, $invoiceID)
    {
        // Sets current language to $locale
        $locale = Config::get('app.locale');

        // Sets locale for all data types (php)
        setlocale(LC_ALL, $locale . '_' . strtoupper($locale), $locale, $locale . '_utf8');

        $user = User::find($request->userID);

        return $user->downloadInvoice($invoiceID, [
            'vendor' => 'WEBcheck',
            'product' => __('Monthly Subscription'),
            'street' => 'Krišjāņa Valdemāra iela 1C',
            'location' => 'Latvija',
            'phone' => '+371 22222222',
        ]);
    }
}
