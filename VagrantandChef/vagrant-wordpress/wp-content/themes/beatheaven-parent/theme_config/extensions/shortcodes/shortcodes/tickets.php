<?php
function tfuse_tickets($atts, $content = null) {
    global $ticket;
    extract(shortcode_atts(array('title'=>''), $atts));
    $ticket = ''; 
    $get_tickets = do_shortcode($content);

    $i = 0;
    $output = '';
    $output .= '<h1>'.$title.'</h1>
        <div class="tickets_list">';
    
        while (isset($ticket['tickettitle'][$i])) {
            $output .= '<div class="ticket clearfix">
                            <div class="ticket_left">
                                <div class="ticket_descr">
                                    <strong>'.$ticket['tickettitle'][$i].'</strong><br>
                                   '.$ticket['desc'][$i].'
                                </div>
                                <div class="ticket_price">'.__('From ', 'tfuse').' <strong>'.$ticket['price'][$i].'</strong></div>
                            </div>';
                            if($ticket['available'][$i] == 'yes')
                            {
                                $output .='<div class="ticket_buy">
                                    <a href="'.$ticket['link'][$i].'" class="btn btn-primary"><span class="icon icon-plus-sign"></span>'.__(' BUY TICKETS NOW', 'tfuse').'</a>
                                </div>';
                            }
                            else
                            {
                                $output .='<div class="ticket_buy">
                                    <a href="'.$ticket['link'][$i].'" class="btn btn-default disabled"><span class="icon icon-remove-sign"></span>'.__(' TICKETS SOLD OUT', 'tfuse').'</a>
                                </div>';
                            }
                            
                        $output .='</div>';
            $i++;
        }
    $output .= '</div>';

    return $output;
}

$atts = array(
    'name' => __('Tickets', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 4,
    'options' => array(
        array(
            'name' => __('Title', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_tickets_title',
            'value' => '',
            'type' => 'text',
            'divider'=>true
        ),
        array(
            'name' => __('Title', 'tfuse'),
            'desc' =>  __('Ticket Title', 'tfuse'),
            'id' => 'tf_shc_tickets_tickettitle',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'text'
        ),
        array(
            'name' => __('Description', 'tfuse'),
            'desc' =>  __('Ticket short description', 'tfuse'),
            'id' => 'tf_shc_tickets_desc',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable'),
            'type' => 'textarea'
        ),
        array(
            'name' => __('Price', 'tfuse'),
            'desc' =>  __('Ticket price from', 'tfuse'),
            'id' => 'tf_shc_tickets_price',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_2 tf_shc_addable'),
            'type' => 'text'
        ),
         array(
            'name' => __('Available', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_tickets_available',
            'value' => '',
            'options' => array('yes' => 'Yes','no' => 'No'),
            'properties' => array('class' => 'tf_shc_addable_3 tf_shc_addable'),
            'type' => 'select',
        ),
        array(
            'name' => __('Link', 'tfuse'),
            'desc' => 'Where to buy ticket',
            'id' => 'tf_shc_tickets_link',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_4 tf_shc_addable tf_shc_addable_last'),
            'type' => 'text',
            'divider' => true
        )
    )
);

tf_add_shortcode('tickets', 'tfuse_tickets', $atts);


function tfuse_ticket($atts, $content = null)
{
    global $ticket;
    extract(shortcode_atts(array('tickettitle' => '', 'desc' => '','available' =>'','price'=>'','link'=>''), $atts));
    $ticket['tickettitle'][] = $tickettitle;
    $ticket['available'][] = $available;
    $ticket['desc'][] = $desc;
    $ticket['price'][] = $price;
    $ticket['link'][] = $link;
}

$atts = array(
    'name' => __('Ticket', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 3,
    'options' => array(
        array(
            'name' => __('Title', 'tfuse'),
            'desc' =>  __('Ticket Title', 'tfuse'),
            'id' => 'tf_shc_ticket_tickettitle',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Description', 'tfuse'),
            'desc' =>  __('Ticket short description', 'tfuse'),
            'id' => 'tf_shc_ticket_desc',
            'value' => '',
            'type' => 'textarea'
        ),
        array(
            'name' => __('Price', 'tfuse'),
            'desc' =>  __('Ticket price from', 'tfuse'),
            'id' => 'tf_shc_ticket_price',
            'value' => '',
            'type' => 'text'
        ),
         array(
            'name' => __('Available', 'tfuse'),
            'desc' => '',
            'id' => 'tf_shc_ticket_available',
            'value' => 'yes',
            'options' => array('yes' => 'Yes','no' => 'No'),
            'type' => 'select',
        ),
        array(
            'name' => __('Link', 'tfuse'),
            'desc' => 'Where to buy ticket',
            'id' => 'tf_shc_ticket_link',
            'value' => '',
            'type' => 'text'
        )
    )
);

add_shortcode('ticket', 'tfuse_ticket', $atts);