<?php



kirbytext::$tags['amazon'] = array(
    'html' => function ($tag) {



        $produkt_id = $tag->attr('amazon');

        include_once("aws_signed_request.php");

        include_once("settings.php");



        $request = aws_signed_request($language, array(
            'Operation' => 'ItemLookup',
            'ItemId' => $produkt_id,
            'ResponseGroup' => 'Large'), $public_key, $private_key, $associate_tag);


        $response = @file_get_contents($request);
        if ($response === FALSE) {
            return "There was a problem with the Amazon-plugin.\n";
        } else {
            // parse XML
            $pxml = simplexml_load_string($response);
            if ($pxml === FALSE) {
                return "There was a problem with the Amazon-plugin.\n";
            } else {

                $imagedata = file_get_contents($pxml->Items->Item->LargeImage->URL);
                $image = new Media($pxml->Items->Item->LargeImage->URL);
                file_put_contents(kirby()->roots()->cache() . DS . $image->filename(), $imagedata);
                $image = new Media(kirby()->roots()->cache() . DS . $image->filename());


                $thumb_link = thumb($image, array("width" => 180, "height" => 180))->url();

                // Start editing your output HTML from here
                $output = '<figure class="amazon">';
                $output .= '<a href="'.urldecode($pxml->Items->Item->DetailPageURL).'" target="_blank">';
                $output .= '<img class="col-sm-3" src="'.$thumb_link.'" >';

                $output .= '<div class="col-sm-9">';
                $output .= '<h3>'.$pxml->Items->Item->ItemAttributes->Title.'</h3>';
                $output .= '<p>Buy now at Amazon for '.$pxml->Items->Item->OfferSummary->LowestNewPrice->FormattedPrice.'</p>';
                $output .= '<small>Affiliatelink used.</small>';

                $output .= '</div></a></figure>';



                return $output;

            }
        }

    }
);