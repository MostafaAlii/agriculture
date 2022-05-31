<!DOCTYPE html>
<html>

<head>
    <title>{{ __('Website/subscriptions.email_notexpired_subject') }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 400;
                src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: normal;
                font-weight: 700;
                src: local('Lato Bold'), local('Lato-Bold'), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 400;
                src: local('Lato Italic'), local('Lato-Italic'), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format('woff');
            }

            @font-face {
                font-family: 'Lato';
                font-style: italic;
                font-weight: 700;
                src: local('Lato Bold Italic'), local('Lato-BoldItalic'), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format('woff');
            }
        }

        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MOBILE STYLES */
        @media screen and (max-width:600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

     
     /* --------------------------------- */
.score {
  display: inline-block;
  font-family: Wingdings;
  font-size: 23px;
  color: #ccc;
  position: relative;
}
.score::before,
.score span::before{
  content: "\2605\2605\2605\2605\2605";
  display: block;
}
.score span {
  color: gold;
  position: absolute;
  top: 0;
  overflow: hidden;
}

    </style>
</head>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;"> We're thrilled to have you here! Get ready to dive into your new account. </div>
    <table style="direction: rtl; border:0; bgcolor:#fcdb5a; cellpadding:0; cellspacing:0; width:100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#fcdb5a" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#fcdb5a" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <h1 style="font-size: 48px; font-weight: 400; margin: 2;">
                            </h1> {{ __('Website/subscriptions.welcome_text') }}
                            <?php
                            use App\Models\Setting;
                            $site= Setting::first();
                            ?>
                            @if(app()->getLocale()=='ar')
                                <img class="img-logo  img-fluid  lazy" src="{{URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo)}}"
                                     data-src="{{URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo)}}" width="70" height="70"
                                     alt="demo"  style="left: 45%;    width: 145px;height: 200px;"/>
                            @else
                                <img class="img-logo  img-fluid  lazy" src="{{URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo)}}"
                                     data-src="{{URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo)}}" width="70" height="70"
                                     alt="demo"  style="left: 45%;    width: 145px;height: 200px;"/>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 800px;">
                    <tr align="center" style="padding: 20px 30px 40px 30px; color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                        <td colspan="5">
                            <p style="margin: 0;">
                               <h2>{{ __('Website/subscriptions.email_notexpired_subject') }}</h2><br>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th>{{__('Website/subscriptions.product_name')}}</th>
                        <th>{{__('Website/subscriptions.product_price')}}</th>
                        <th>{{__('Website/subscriptions.product_image')}}</th>
                        <th>{{__('Website/subscriptions.product_rate')}}</th>
                        <th>{{__('Website/subscriptions.product_link')}}</th>
                    </tr>
                    <?php
                    use App\Models\Product;
                    $products=Product::orderBy('id','desc')->limit('10')->get();
                    foreach($products as $p){
                        echo '<tr>
                                <td>'.$p->name.'</td>
                                <td>'.$p->price.'</td>
                               
                                <td>'; ?>
                                <img style="width:100px;height:100px;" src="{{ asset('Dashboard/img/products/' . $p->image->filename) }}" data-src="{{ asset('Dashboard/img/products/' . $p->image->filename) }}"/>
                                <?php echo'</td>
                                <td><span class="score"><span style="width:'.$p->productRate().'%"></span></span></td>
                                <td>';?>
                                <a href="{{route('product_details', encrypt($p->id))}}">{{__('Website/subscriptions.product_link')}}</a>
                                <?php
                                echo'</td>
                            </tr>';
                    }
                    ?>
                    <tr>
                        <td align="center" style="border-radius: 3px;" bgcolor="#fcdb5a" colspan="5">
                            <a href="{{ url('http://127.0.0.1:8000/'. app()->getLocale() .'/home2') }}" target="_blank" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #f4f4f4; text-decoration: none; color: #f4f4f4; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #fcdb5a; display: inline-block;">
                                {{ __('Website/subscriptions.website') }}
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
