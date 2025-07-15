<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QeYku8dmWcvbOQxa',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/send-sms-notification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RvjLzwDei9j2x5Gw',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iaJCjkS4sl9AIPAr',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/home' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OcVdMSWD4pudOjNm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/my_board' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'my_board',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search_home_page' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dBhmewJcbhk6JtRB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dashboard' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'dashboard',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_data_of_week' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QNUeQROAEETdHXid',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NeWJz94FcUZX2MIu',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CpQeOa549CvhMSQo',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Pc4Kc0mJIjkgi7ed',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff_register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FK71T3EbB47Imo2b',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/performance' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'performance',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/submit_sticky_note' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::K8gBFUInAyao0umR',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/create_announcment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9awHNc40UZ7KAwgC',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_note_attachments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::DcE2U12rug4xwtPd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/announcement_replies' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PTClsplWE45pSLaU',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_announcement_data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tHmntUzbT0M99V1G',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reply_to_announcement' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::eihHaxLirJh7mmCs',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_employee_attachments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LJoiEhnSrLhWN3qF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/complains_orders' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'complaint_pending',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/complains_orders_archived' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'complaint_archived',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/solved' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pg7jcAvH4Jpb9055',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/send_message' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::i01bU9uGUfeObBMJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reply_complaint' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jiEqBZDdw3miGG0z',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_replies' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pX5TIYV6ik7wZsxA',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/need_help' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZkA66mxUPcaT9YFL',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/send_first_mail_again' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::u57tanMsmUuKjxgF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/send_details_mail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BrhugjfYTQWSJXLu',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/send_tracking_mail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UoDdCnuRNkA3emMO',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/request_to_cancel_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::wfcR1ER67Efs5m5s',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/reschedule_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::suA6ZkRKRqyiDhCu',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/lmd_or_late' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4ggHmKCbF3dWeMcR',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/customer_others' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SnzMSXEGhwOvBtRb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ask_about_product' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0KDmU4nVDXNv2D5l',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/guest_others' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6vAEurMgfhVzp6i6',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_order_details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sM22A4JED4yRmDkJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/dicount_codes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::erV9s4vcy3QZsOqP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/services_payments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SoYuTnDRna9TqDkZ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/FAQS' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aoptDNv8zMBt1Ebe',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_dicounts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XvVZy0cKdIwzr2nW',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_discounts' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5tRlDQ962CnzQTKX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_services_payments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::q8H8wP27PEF7TSUN',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_services_payments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ynJzfe9DvA3ekIue',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search_complaints' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Fqi61IffQxaw0xas',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_faqs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YS00sExd6RHPkHwE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_faqs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::z7ZnmaKtmdXvHK82',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/send_something_wrong_mail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nyQsQPw5F6prxJDq',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/complains_special_orders' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'complaint_special',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/new_chat' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ppj8iYfjo6HZ5KIk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/all_faqs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jDmfCjjEr58ib5XJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/open_ticket' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uEL9pbIn5meHgpVO',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/complains_by_CS' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'complaint_CS',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import_domestic_excel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5cPcXnq3LezVPeiI',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import_domestic_excel/upload' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cl3Qp1XJgGL3Tzx3',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/download_glt' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::G4jHiT03ChEOAXS0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_items' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BUJObuHwxCvm0CsG',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/leftTheHub' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7O9XzV018lTGWqBM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/delivery' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AnZ6HXcWloR3DnTu',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/domestic' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2poxbcoRXuW74XkS',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/add_values' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XJEqnmfj5QCPYWSP',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/submit_offline_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ZrbnvUgSRtKvaVp1',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/products_search' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aEjs1GqHARc2P7Z6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/park_ksa' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TbJW1CGm5jIOa0HV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/products_search_data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::54bKZsW6gafAIG8D',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_similar_item_by_barcode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9O2KxpUddC5YO1kC',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/products' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'products',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/products_search_data_by_barcode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xCT5p8hVviwKIuNQ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/products_search_data_by_shopify_product_id' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9Pb2MWnVRaXUYCcF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/duplicate_product_by_product_id' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::W2E9VBl2MsmzSnPm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/TP_question' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ci1ge0N2ljrpCudj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pre_alert' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pre_alert',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/products_expired' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'products_expired',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search_products' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CzBmamEU2zjItd3s',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search_products_result' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::a9qQce2QUKXVYNl3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_variants' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ng12wb1g1wm293QH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/download_variant_barcode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jhAxd2JyUmv3vIlZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/products_in' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'products_in',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/products_out' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'products_out',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/scan_variant_barcode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Tfe75KlzqGjMchea',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/submit_variants_barcodes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ujj7tqmLhLSRedhf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export_sales_report' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RMlniQtvaRNZPLQM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export_products_filters' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::exho0RtlnQivJ21Y',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/first_verification' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pending',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/first_verification_confirmed' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'confirmed',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/first_verification_edited' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edited',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/first_verification_SVM' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'SVM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/first_verification_FVM' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'FVM',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/first_verification_archived' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification_archived',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/first_verification_export' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GnXc17swTJXhIUEM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/preorder' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jwraX21LitJD5i9e',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/paid' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WbRnmTrC3FBpdy4z',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ignore' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JueoP0nGo6KyPeP0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/verification_mail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tNFxjWZ8de7wansb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/correct_mail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AsLJfu6b6hhuh4Ga',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/send_correct_whatsApp_message' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::v5oYkmJcajH2pGc2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hH3GJC4JZVuLK3C5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cancel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::47zMA3vlEFeZqGCD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cancel_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ar7PGh9JXpP6X4Ve',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/submit_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Edr8UVeFnG8gViKn',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/edit' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2BmumPsO2PXFGzj1',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/edit_manually' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'manuall',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_editing' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QhpiepRNqPowoNqC',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/first_verification_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MaSE2xXuGkFRcSCg',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/edit_email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uspKwBc0WLta6hOy',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/add_group_tracking' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oYepq9HARRZ1MoKG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/first_verification_onHold' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'on_hold',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_fulfilment_to_on_hold' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FWZay1Q1gxLXOvGr',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_fulfilment_to_release' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GC2BYatwLe44gXA2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/edit_phone' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IISAIQlV0sUfmqvq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/resend_fvm_message' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VpNYF6tEolGJCC87',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/group_order_form' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::t7JNsWRUBgkW5hBV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/create_group_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fe9R3TQSnZSt8DRr',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/group_orders' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'group_orders',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/change_zones_status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::smhOCoNygl2qmSSB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_group_product' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ou8yQnCmJmqMhxaY',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_zones' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2SO8cawvVobmQYnp',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_group_products' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::O9rMGXlf5OlaJwui',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_group_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FPXoKXuY5KIGQHCq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_active_group_products' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2ZTFjlZHSFrc0eOz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_active_zones' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NacWSbLyKYTbkCvH',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/confirmed_group_orders' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'confirmed_group_orders',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/send_group_order_mail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jlqRO1cVZjxBkyRl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/confirm_group' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FxHsiDO8U7iLipem',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cancel_group' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jJYrNAM9ZtsrRMHC',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_group_items' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Zj23xclrc0KA6vqr',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/group_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::q1HoX4vIb4N2hzO3',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/left_group_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mv2Q9p44HtkF4ymq',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/group_order_data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pTUS1QazhBkZuiqL',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/orders_by_awb' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'orders_by_awb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/verified' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verified',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/on_process' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'on_process',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/fulfilled' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'fulfilled',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tst' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'tst',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/archived' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'archived',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/move_to_on_process' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::iAMjg2QC4rgXEXEF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/fulfill_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sAGEnEneu0ddcdNK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/return_to_stock' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7IQBufeHHmZ4CMGy',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/erp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::fsgv7fVndDXM3IaW',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cancel_confirmed' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::uF7OwABNCt6t4UwZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/cancel_tst' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::w5eOxOcxBYx5BGqA',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/return_to_confirmed' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::m2RObDqCzHVMmuar',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/send_to_fct' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::CgD9LMfrxqLn3JyB',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/submit_tst' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::PdfW109jcxbjlYSE',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search_tst_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pl8GsOUHEtxTrDTM',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/bulk' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bulk',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export_tst' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AFGSUAVyfVfkVo8j',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/export_archived' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OsPYdYMXXgNmeIQS',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/submit_awb_data' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::z3Qd4p5JMPEweZom',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/remove_from_awbs' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::11zpwHmyoJit8Apt',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_similar_item' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jHZjRZHyT3xKiD9p',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/return_qty_to_stock' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::b49aOs6UUIPcO3r2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/create_new_variant' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NOaZmBEHY2y9NGFI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/create_new_product_return' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vdsgzyGbPd7vipW4',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/fct' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'fct',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/archived_fct' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'fct_archived',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/submit_fct' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::YNWWtumx2s5Hhr4p',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search_fct' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qaatAtv50gA6RrUm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/assign_task' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::maGalCCT0CM40b1h',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/tasks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'tasks',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_users' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RIcwOqjr0PZWJI7A',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/archived_tasks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'tasks_archived',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/assigned_tasks' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'assigned',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/new_currency' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::UZ6bCiqkfGGgnmqV',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/add_task' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kW2rGlma6lrafLwl',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_currency' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::K5baAGvYcVSRrnAD',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/task_status' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::G2zQDR6X0ByODZrI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/assign_reply' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oHmMloHE4QisSs1F',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/task_details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::upRC9q1HKu7CIZb9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/emails' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2rq3FTsZ5K0i5DE4',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/staff_bulk_awb' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::euU7Flhe6r6Pk8XB',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/awb_bulk_upload_express' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::meg4NVj5HGiDziFF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/get_country_cities' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9fYWFwVYxMLOhL7T',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/send_shipper_info' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BfSAnUPcOqvDzEb9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/create_new_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VAirEr1ypY8ifJCm',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/scan_barcode' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::M5yqGiDsLI6JVl3k',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/under_review' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::zBDEkSrXsqlQBnLE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/new_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/shippment_list' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'shipments',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::TVZNn6Ix2zC9yhrq',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/delete_shipment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::EbbXRxiTadMOKS7Q',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/track/shipment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::22YlvLW5F9Nc1Q0N',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/add_claim' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kQQ1fvszxH1uJm8s',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/scanBarcodes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'scan_barcodes',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/shipments_managment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'warehouse',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pending_shipments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pending_shipments',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/client_shipment_awb' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'create_awb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/client_bulk_shipment_awb' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'create_bulk_awb',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/awb_bulk_upload' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IWbHzHbg7D3PUN0I',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/submit_barcodes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::84snJLiXJb0uplaX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/submit_dispatch' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hJc0DEdBc54tXIxF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/generate_awb' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cZvwaBe6VpQuHx3G',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/download_awb' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::lm7cpNhoC7hjv2Kh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/accounts_managment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'accounts',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/toggle_active' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LWfOpdU70bPXnbVq',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/scanBarcodes_details' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::sILxUmOFvkSfpDl6',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/search_shipment' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::F1fAzwnKjcIWOiVD',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/vendors_shipments' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'vendors',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/mohsen' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kBFfrC99bgC7Y0Ra',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import_file' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3TUftsrjMrnRsPfT',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/user_url' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::hYQ5KmueArRzRAtX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/upload_orders' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'upload',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import_excel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kPxqjPBBKHAnqm4P',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import_excel/import' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cTWMlYsifgzHNGeR',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import_excel/aramex' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3vsrVkw7XjDVxF9r',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/import_excel/product' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NZicBXrpfdiMYkeS',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/QRcodes' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0bmtQA5f9RNHAfFE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/generate' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::420tp2kQAXDZYCXt',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/scan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yAfHxQWJJLSizydE',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/wrong' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vgo77fV88f1uIdpK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/refused_orders' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VasKFBVDkrG1evHc',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/delivered' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::i2yWMEdjdtVBz3NU',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/delivered_process' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::HOjggev9zECQzSN5',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/wrongPhone' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vDjZiUSSsZcBD3yK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/refused' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SZoBhZXyGpis9nAz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/refused_process' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Y3BVFWTSkkx1EP1n',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/refused_cancel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2abPbNmFhdWTbHDv',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/contact_support' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::k0pFytmF2lCy9usr',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/requests' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WBQf5aQoqhUpMPJV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/support_change' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::QDNPHAQjQyb37Smj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/fulfilment_placed_on_hold' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dtjb9q6ae4PRB3uJ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/fulfilment_hold_release' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JhE0ujAtzAZnUky0',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/order_edited_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kWyCq2GlqF31lMnb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/all_manual_create_new_order' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VdNho6eqa3tbGMnh',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/egypt_order_create_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RRxnF0tOglIrJ7Bw',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/egypt_order_cancelled_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GoqAeWG2oJ7ISr4e',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/egypt_order_paid_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0LgVBY0zmwzUhbWE',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/egypt_order_updated_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3VndR4uPhTZDAYmw',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/egypt_product_new_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9hQtolSlkz0Xx4pA',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/egypt_product_updated_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3nLwC5HiAGfxftJX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/egypt_product_delete_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::t3JsNczpntDiqedX',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/origin_order_create_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Zt4OYERq5V888zaz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/origin_order_updated_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nVfyvZRrCVHnrVbf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/origin_order_cancelled_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::i81UNWLWEIeWclR9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/origin_order_paid_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::A4SUl5IB5E47Bd2N',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/origin_product_new_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7jhUnzfvDLL3r8tk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/origin_product_updated_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::utBgCJpcn7sb6iNH',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/origin_product_delete_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6xLquhTuofsERL07',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ksa_order_create_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::K6KCWBdwOxU87TNg',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ksa_order_updated_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::H6Pv8J6chOu5NVZ2',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ksa_order_cancelled_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::tD43VbwlaDT09Fdh',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ksa_order_paid_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::q7Sc6AjNan5NluZb',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ksa_product_new_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Jlz3cF8bcZW1Rhxs',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ksa_product_updated_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::9o1XnzJpe2YDFJSP',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ksa_product_delete_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::mKay7SBQ8ntYvRta',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/kuwait_order_create_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MiB0Yhk3u91UX8GZ',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/kuwait_order_cancelled_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::3uv3vM8zI7PhKBDA',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/kuwait_order_paid_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4mBM3x9VC2gygFGd',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/kuwait_product_new_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::KdGEUPlo0gNKPdI9',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/kuwait_product_updated_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XfWaE953yMAjq9GF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/kuwait_product_delete_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::yYjksTYGKgSjexpi',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/uae_order_create_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WjjGW9wqj2qXrEzz',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/uae_order_cancelled_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::E45ZtyLbFy7qHOHE',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/uae_order_paid_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5hCHmY404gC12J0h',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/uae_product_new_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::AfJ5sOKAfCWh9PoG',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/uae_product_updated_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5MSkkiiPAy1cxTbF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/uae_product_delete_webhook' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WiKsfqBl1Es9mpYy',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/whatsapp' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0Y0gwa2edPGK4zdn',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7GmO7qMR5qiBHeLf',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/whatsapp_send_msg' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::LYGCmsib5sk6aRuJ',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/something' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oo2I3m2NrzuYqeyX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/UpdateTrackingStatus' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::v9CkDo7i8H0aKIjE',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/password/reset/([^/]++)(*:31)|/complaint_ticket/(?|([^/]++)(*:67)|customer_complaint_reply(*:98)|rating(*:111))|/special_order/(?|([^/]++)(*:146)|submit_somthing_wrong_form(*:180))|/tracking/([^/]++)(*:207))/?$}sDu',
    ),
    3 => 
    array (
      31 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      67 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2laJ8yKMVmX4hlTA',
          ),
          1 => 
          array (
            0 => 'complain_number',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      98 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::qIDI4FtzGOJgq4VT',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      111 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::6YhS94ZJgJ1xLjTw',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      146 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JCdjNLb7Bo2ZXHsM',
          ),
          1 => 
          array (
            0 => 'complain_id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      180 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NDz6Gh6BS35HUqcE',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      207 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::cgawUSXqXYXoThEK',
          ),
          1 => 
          array (
            0 => 'kshopina_tracking',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::QeYku8dmWcvbOQxa' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:297:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:79:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000006100000000000000000";}";s:4:"hash";s:44:"m6imNX5MkUtILR8f9NKB6PdMqCq3AR/WJI8U+XQ9aFg=";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::QeYku8dmWcvbOQxa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RvjLzwDei9j2x5Gw' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'send-sms-notification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\NotificationController@sendSmsNotificaition',
        'controller' => 'App\\Http\\Controllers\\NotificationController@sendSmsNotificaition',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::RvjLzwDei9j2x5Gw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iaJCjkS4sl9AIPAr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@main',
        'controller' => 'App\\Http\\Controllers\\HomeController@main',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::iaJCjkS4sl9AIPAr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OcVdMSWD4pudOjNm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'home',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@main',
        'controller' => 'App\\Http\\Controllers\\HomeController@main',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::OcVdMSWD4pudOjNm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'my_board' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'my_board',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@dashboard_info',
        'controller' => 'App\\Http\\Controllers\\HomeController@dashboard_info',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'my_board',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dBhmewJcbhk6JtRB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'search_home_page',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@search_home_page',
        'controller' => 'App\\Http\\Controllers\\HomeController@search_home_page',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::dBhmewJcbhk6JtRB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\HomeController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'dashboard' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dashboard',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@dashboard',
        'controller' => 'App\\Http\\Controllers\\HomeController@dashboard',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'dashboard',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QNUeQROAEETdHXid' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'get_data_of_week',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@get_data_of_week',
        'controller' => 'App\\Http\\Controllers\\HomeController@get_data_of_week',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::QNUeQROAEETdHXid',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NeWJz94FcUZX2MIu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::NeWJz94FcUZX2MIu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CpQeOa549CvhMSQo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::CpQeOa549CvhMSQo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Pc4Kc0mJIjkgi7ed' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Pc4Kc0mJIjkgi7ed',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FK71T3EbB47Imo2b' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff_register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:270:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:52:"function () {
    return \\view(\'auth.register\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000061a0000000000000000";}";s:4:"hash";s:44:"1L4AglFV/h4PVnu5K46sYTaFqdbpYuHbV1Q8VDfUPII=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::FK71T3EbB47Imo2b',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'performance' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'performance',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'userAdmin',
        ),
        'uses' => 'App\\Http\\Controllers\\PerformanceController@performancePage',
        'controller' => 'App\\Http\\Controllers\\PerformanceController@performancePage',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'performance',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::K8gBFUInAyao0umR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'submit_sticky_note',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@submit_sticky_note',
        'controller' => 'App\\Http\\Controllers\\HomeController@submit_sticky_note',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::K8gBFUInAyao0umR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9awHNc40UZ7KAwgC' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'create_announcment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@create_announcment',
        'controller' => 'App\\Http\\Controllers\\HomeController@create_announcment',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::9awHNc40UZ7KAwgC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::DcE2U12rug4xwtPd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'get_note_attachments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@get_note_attachments',
        'controller' => 'App\\Http\\Controllers\\HomeController@get_note_attachments',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::DcE2U12rug4xwtPd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PTClsplWE45pSLaU' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'announcement_replies',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@get_announcement_replies',
        'controller' => 'App\\Http\\Controllers\\HomeController@get_announcement_replies',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::PTClsplWE45pSLaU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tHmntUzbT0M99V1G' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'get_announcement_data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@get_announcment_data',
        'controller' => 'App\\Http\\Controllers\\HomeController@get_announcment_data',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::tHmntUzbT0M99V1G',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::eihHaxLirJh7mmCs' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reply_to_announcement',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@reply_to_announcement',
        'controller' => 'App\\Http\\Controllers\\HomeController@reply_to_announcement',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::eihHaxLirJh7mmCs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LJoiEhnSrLhWN3qF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'get_employee_attachments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@get_employee_attachments',
        'controller' => 'App\\Http\\Controllers\\HomeController@get_employee_attachments',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::LJoiEhnSrLhWN3qF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'complaint_pending' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'complains_orders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@complains_page',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@complains_page',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'complaint_pending',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'complaint_archived' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'complains_orders_archived',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@complains_page_archived',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@complains_page_archived',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'complaint_archived',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pg7jcAvH4Jpb9055' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'solved',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@solved',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@solved',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::pg7jcAvH4Jpb9055',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::i01bU9uGUfeObBMJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'send_message',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@send_message',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@send_message',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::i01bU9uGUfeObBMJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jiEqBZDdw3miGG0z' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reply_complaint',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@reply_complaint',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@reply_complaint',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jiEqBZDdw3miGG0z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2laJ8yKMVmX4hlTA' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'complaint_ticket/{complain_number}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@get_complaint_replies',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@get_complaint_replies',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::2laJ8yKMVmX4hlTA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qIDI4FtzGOJgq4VT' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'complaint_ticket/customer_complaint_reply',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@customer_complaint_reply',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@customer_complaint_reply',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::qIDI4FtzGOJgq4VT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6YhS94ZJgJ1xLjTw' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'complaint_ticket/rating',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@send_rating',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@send_rating',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::6YhS94ZJgJ1xLjTw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pX5TIYV6ik7wZsxA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'get_replies',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@get_replies',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@get_replies',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::pX5TIYV6ik7wZsxA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZkA66mxUPcaT9YFL' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'need_help',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@kmex_bot',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@kmex_bot',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ZkA66mxUPcaT9YFL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::u57tanMsmUuKjxgF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'send_first_mail_again',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@send_first_mail_again',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@send_first_mail_again',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::u57tanMsmUuKjxgF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BrhugjfYTQWSJXLu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'send_details_mail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@send_details_mail',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@send_details_mail',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::BrhugjfYTQWSJXLu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UoDdCnuRNkA3emMO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'send_tracking_mail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@send_tracking_mail',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@send_tracking_mail',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::UoDdCnuRNkA3emMO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::wfcR1ER67Efs5m5s' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'request_to_cancel_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@request_to_cancel_order',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@request_to_cancel_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::wfcR1ER67Efs5m5s',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::suA6ZkRKRqyiDhCu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'reschedule_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@reschedule_order',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@reschedule_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::suA6ZkRKRqyiDhCu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4ggHmKCbF3dWeMcR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'lmd_or_late',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@lmd_or_late',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@lmd_or_late',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::4ggHmKCbF3dWeMcR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SnzMSXEGhwOvBtRb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'customer_others',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@customer_others',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@customer_others',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::SnzMSXEGhwOvBtRb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0KDmU4nVDXNv2D5l' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ask_about_product',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@ask_about_product',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@ask_about_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::0KDmU4nVDXNv2D5l',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6vAEurMgfhVzp6i6' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'guest_others',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@guest_others',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@guest_others',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::6vAEurMgfhVzp6i6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sM22A4JED4yRmDkJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_order_details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@get_order_details',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@get_order_details',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::sM22A4JED4yRmDkJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::erV9s4vcy3QZsOqP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'dicount_codes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@get_active_dicounts',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@get_active_dicounts',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::erV9s4vcy3QZsOqP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SoYuTnDRna9TqDkZ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'services_payments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@get_services_payments',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@get_services_payments',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::SoYuTnDRna9TqDkZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aoptDNv8zMBt1Ebe' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'FAQS',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@faqs',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@faqs',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::aoptDNv8zMBt1Ebe',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XvVZy0cKdIwzr2nW' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_dicounts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@get_dicounts',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@get_dicounts',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::XvVZy0cKdIwzr2nW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5tRlDQ962CnzQTKX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update_discounts',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@update_discounts',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@update_discounts',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::5tRlDQ962CnzQTKX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::q8H8wP27PEF7TSUN' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_services_payments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@get_services_payments',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@get_services_payments',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::q8H8wP27PEF7TSUN',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ynJzfe9DvA3ekIue' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update_services_payments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@update_services_payments',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@update_services_payments',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ynJzfe9DvA3ekIue',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Fqi61IffQxaw0xas' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'search_complaints',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@search_complaints',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@search_complaints',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Fqi61IffQxaw0xas',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YS00sExd6RHPkHwE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_faqs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@get_faqs_question',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@get_faqs_question',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::YS00sExd6RHPkHwE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::z7ZnmaKtmdXvHK82' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update_faqs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@update_faqs_question',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@update_faqs_question',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::z7ZnmaKtmdXvHK82',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nyQsQPw5F6prxJDq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'send_something_wrong_mail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@send_something_wrong_mail',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@send_something_wrong_mail',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::nyQsQPw5F6prxJDq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JCdjNLb7Bo2ZXHsM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'special_order/{complain_id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@something_wrong_form',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@something_wrong_form',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::JCdjNLb7Bo2ZXHsM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NDz6Gh6BS35HUqcE' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'special_order/submit_somthing_wrong_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@submit_somthing_wrong_form',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@submit_somthing_wrong_form',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::NDz6Gh6BS35HUqcE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'complaint_special' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'complains_special_orders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@complains_special_page',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@complains_special_page',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'complaint_special',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ppj8iYfjo6HZ5KIk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'new_chat',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:276:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:58:"function () {
        return \\view(\'new_chatbot\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000006510000000000000000";}";s:4:"hash";s:44:"3Mrxo/s9A6oS4IYM4zQsGpDe1F+1b0dzUrBD7jiZsJM=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Ppj8iYfjo6HZ5KIk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jDmfCjjEr58ib5XJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'all_faqs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@all_faqs',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@all_faqs',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jDmfCjjEr58ib5XJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uEL9pbIn5meHgpVO' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'open_ticket',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@open_ticket_CS_side',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@open_ticket_CS_side',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::uEL9pbIn5meHgpVO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'complaint_CS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'complains_by_CS',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ComplainsController@complains_by_CS',
        'controller' => 'App\\Http\\Controllers\\ComplainsController@complains_by_CS',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'complaint_CS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5cPcXnq3LezVPeiI' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'import_domestic_excel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\DomesticController@import',
        'controller' => 'App\\Http\\Controllers\\DomesticController@import',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::5cPcXnq3LezVPeiI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cl3Qp1XJgGL3Tzx3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'import_domestic_excel/upload',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\DomesticController@upload',
        'controller' => 'App\\Http\\Controllers\\DomesticController@upload',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::cl3Qp1XJgGL3Tzx3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::G4jHiT03ChEOAXS0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'download_glt',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\DomesticController@download_glt',
        'controller' => 'App\\Http\\Controllers\\DomesticController@download_glt',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::G4jHiT03ChEOAXS0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BUJObuHwxCvm0CsG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_items',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DomesticController@get_items',
        'controller' => 'App\\Http\\Controllers\\DomesticController@get_items',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::BUJObuHwxCvm0CsG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7O9XzV018lTGWqBM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'leftTheHub',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\DomesticController@left_the_hub',
        'controller' => 'App\\Http\\Controllers\\DomesticController@left_the_hub',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::7O9XzV018lTGWqBM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AnZ6HXcWloR3DnTu' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'delivery',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DomesticController@delivery',
        'controller' => 'App\\Http\\Controllers\\DomesticController@delivery',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::AnZ6HXcWloR3DnTu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2poxbcoRXuW74XkS' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'domestic',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\DomesticController@index',
        'controller' => 'App\\Http\\Controllers\\DomesticController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::2poxbcoRXuW74XkS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XJEqnmfj5QCPYWSP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'add_values',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:275:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:57:"function () {
        return \\view(\'add_values\');
    }";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000000000065d0000000000000000";}";s:4:"hash";s:44:"+hUJkFnOT5hxz4v/zfozj8HsvDwfgbqH/Ofd0WUVRSs=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::XJEqnmfj5QCPYWSP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ZrbnvUgSRtKvaVp1' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'submit_offline_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@submit_offline_order',
        'controller' => 'App\\Http\\Controllers\\StockController@submit_offline_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ZrbnvUgSRtKvaVp1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aEjs1GqHARc2P7Z6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'products_search',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@products_search_page',
        'controller' => 'App\\Http\\Controllers\\StockController@products_search_page',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::aEjs1GqHARc2P7Z6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TbJW1CGm5jIOa0HV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'park_ksa',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@products_search_page_admin',
        'controller' => 'App\\Http\\Controllers\\StockController@products_search_page_admin',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::TbJW1CGm5jIOa0HV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::54bKZsW6gafAIG8D' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'products_search_data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@products_search_data',
        'controller' => 'App\\Http\\Controllers\\StockController@products_search_data',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::54bKZsW6gafAIG8D',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9O2KxpUddC5YO1kC' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'get_similar_item_by_barcode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@get_similar_item_by_barcode',
        'controller' => 'App\\Http\\Controllers\\StockController@get_similar_item_by_barcode',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::9O2KxpUddC5YO1kC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'products' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'products',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@index',
        'controller' => 'App\\Http\\Controllers\\StockController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'products',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xCT5p8hVviwKIuNQ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'products_search_data_by_barcode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@products_search_data_by_barcode',
        'controller' => 'App\\Http\\Controllers\\StockController@products_search_data_by_barcode',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::xCT5p8hVviwKIuNQ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9Pb2MWnVRaXUYCcF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'products_search_data_by_shopify_product_id',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@products_search_data_by_shopify_product_id',
        'controller' => 'App\\Http\\Controllers\\StockController@products_search_data_by_shopify_product_id',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::9Pb2MWnVRaXUYCcF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::W2E9VBl2MsmzSnPm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'duplicate_product_by_product_id',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@duplicate_product_by_product_id',
        'controller' => 'App\\Http\\Controllers\\StockController@duplicate_product_by_product_id',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::W2E9VBl2MsmzSnPm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ci1ge0N2ljrpCudj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'TP_question',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@tp_submit_question',
        'controller' => 'App\\Http\\Controllers\\StockController@tp_submit_question',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Ci1ge0N2ljrpCudj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pre_alert' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pre_alert',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@pre_alert_page',
        'controller' => 'App\\Http\\Controllers\\StockController@pre_alert_page',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pre_alert',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'products_expired' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'products_expired',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@out_of_stock_page',
        'controller' => 'App\\Http\\Controllers\\StockController@out_of_stock_page',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'products_expired',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CzBmamEU2zjItd3s' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'search_products',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@search_products',
        'controller' => 'App\\Http\\Controllers\\StockController@search_products',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::CzBmamEU2zjItd3s',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::a9qQce2QUKXVYNl3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'search_products_result',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@search_products_result',
        'controller' => 'App\\Http\\Controllers\\StockController@search_products_result',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::a9qQce2QUKXVYNl3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ng12wb1g1wm293QH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'get_variants',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@get_variants',
        'controller' => 'App\\Http\\Controllers\\StockController@get_variants',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ng12wb1g1wm293QH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jhAxd2JyUmv3vIlZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'download_variant_barcode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@download_variant_barcode',
        'controller' => 'App\\Http\\Controllers\\StockController@download_variant_barcode',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jhAxd2JyUmv3vIlZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'products_in' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'products_in',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@products_in',
        'controller' => 'App\\Http\\Controllers\\StockController@products_in',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'products_in',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'products_out' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'products_out',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@products_out',
        'controller' => 'App\\Http\\Controllers\\StockController@products_out',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'products_out',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Tfe75KlzqGjMchea' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'scan_variant_barcode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@scan_variant_barcode',
        'controller' => 'App\\Http\\Controllers\\StockController@scan_variant_barcode',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Tfe75KlzqGjMchea',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ujj7tqmLhLSRedhf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'submit_variants_barcodes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@submit_variants_barcodes',
        'controller' => 'App\\Http\\Controllers\\StockController@submit_variants_barcodes',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Ujj7tqmLhLSRedhf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RMlniQtvaRNZPLQM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'export_sales_report',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@export_sales_report',
        'controller' => 'App\\Http\\Controllers\\StockController@export_sales_report',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::RMlniQtvaRNZPLQM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::exho0RtlnQivJ21Y' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'export_products_filters',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@export_products_filters',
        'controller' => 'App\\Http\\Controllers\\StockController@export_products_filters',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::exho0RtlnQivJ21Y',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pending' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'first_verification',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@index',
        'controller' => 'App\\Http\\Controllers\\VerificationController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pending',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'confirmed' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'first_verification_confirmed',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@confirmed',
        'controller' => 'App\\Http\\Controllers\\VerificationController@confirmed',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'confirmed',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'edited' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'first_verification_edited',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@edited',
        'controller' => 'App\\Http\\Controllers\\VerificationController@edited',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'edited',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'SVM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'first_verification_SVM',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@SVM',
        'controller' => 'App\\Http\\Controllers\\VerificationController@SVM',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'SVM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'FVM' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'first_verification_FVM',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@FVM',
        'controller' => 'App\\Http\\Controllers\\VerificationController@FVM',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'FVM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'verification_archived' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'first_verification_archived',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@archived',
        'controller' => 'App\\Http\\Controllers\\VerificationController@archived',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'verification_archived',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GnXc17swTJXhIUEM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'first_verification_export',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@export',
        'controller' => 'App\\Http\\Controllers\\VerificationController@export',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::GnXc17swTJXhIUEM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jwraX21LitJD5i9e' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'preorder',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@add_to_preorder',
        'controller' => 'App\\Http\\Controllers\\VerificationController@add_to_preorder',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jwraX21LitJD5i9e',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WbRnmTrC3FBpdy4z' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'paid',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@add_to_paid',
        'controller' => 'App\\Http\\Controllers\\VerificationController@add_to_paid',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::WbRnmTrC3FBpdy4z',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JueoP0nGo6KyPeP0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ignore',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@ignore_order',
        'controller' => 'App\\Http\\Controllers\\VerificationController@ignore_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::JueoP0nGo6KyPeP0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tNFxjWZ8de7wansb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'verification_mail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@verification_mail',
        'controller' => 'App\\Http\\Controllers\\VerificationController@verification_mail',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::tNFxjWZ8de7wansb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AsLJfu6b6hhuh4Ga' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'correct_mail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@correct_mail',
        'controller' => 'App\\Http\\Controllers\\VerificationController@correct_mail',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::AsLJfu6b6hhuh4Ga',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::v5oYkmJcajH2pGc2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'send_correct_whatsApp_message',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@send_correct_whatsApp_message',
        'controller' => 'App\\Http\\Controllers\\VerificationController@send_correct_whatsApp_message',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::v5oYkmJcajH2pGc2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hH3GJC4JZVuLK3C5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@confirm_order',
        'controller' => 'App\\Http\\Controllers\\VerificationController@confirm_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::hH3GJC4JZVuLK3C5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::47zMA3vlEFeZqGCD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cancel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@cancel_order',
        'controller' => 'App\\Http\\Controllers\\VerificationController@cancel_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::47zMA3vlEFeZqGCD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ar7PGh9JXpP6X4Ve' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cancel_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@cancel_order_shopify',
        'controller' => 'App\\Http\\Controllers\\VerificationController@cancel_order_shopify',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::ar7PGh9JXpP6X4Ve',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Edr8UVeFnG8gViKn' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'submit_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@update_shopify',
        'controller' => 'App\\Http\\Controllers\\VerificationController@update_shopify',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Edr8UVeFnG8gViKn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2BmumPsO2PXFGzj1' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@resubmit',
        'controller' => 'App\\Http\\Controllers\\VerificationController@resubmit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::2BmumPsO2PXFGzj1',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'manuall' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'edit_manually',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@edit_manually',
        'controller' => 'App\\Http\\Controllers\\VerificationController@edit_manually',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'manuall',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QhpiepRNqPowoNqC' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update_editing',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@update_editing',
        'controller' => 'App\\Http\\Controllers\\VerificationController@update_editing',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::QhpiepRNqPowoNqC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MaSE2xXuGkFRcSCg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'first_verification_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@search_orders_result',
        'controller' => 'App\\Http\\Controllers\\VerificationController@search_orders_result',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::MaSE2xXuGkFRcSCg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uspKwBc0WLta6hOy' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'edit_email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@edit_email',
        'controller' => 'App\\Http\\Controllers\\VerificationController@edit_email',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::uspKwBc0WLta6hOy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oYepq9HARRZ1MoKG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'add_group_tracking',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@add_group_tracking',
        'controller' => 'App\\Http\\Controllers\\VerificationController@add_group_tracking',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::oYepq9HARRZ1MoKG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'on_hold' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'first_verification_onHold',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@on_hold',
        'controller' => 'App\\Http\\Controllers\\VerificationController@on_hold',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'on_hold',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FWZay1Q1gxLXOvGr' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update_fulfilment_to_on_hold',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@update_fulfilment_to_on_hold',
        'controller' => 'App\\Http\\Controllers\\VerificationController@update_fulfilment_to_on_hold',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::FWZay1Q1gxLXOvGr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GC2BYatwLe44gXA2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update_fulfilment_to_release',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@update_fulfilment_to_release',
        'controller' => 'App\\Http\\Controllers\\VerificationController@update_fulfilment_to_release',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::GC2BYatwLe44gXA2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IISAIQlV0sUfmqvq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'edit_phone',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@edit_phone',
        'controller' => 'App\\Http\\Controllers\\VerificationController@edit_phone',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::IISAIQlV0sUfmqvq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VpNYF6tEolGJCC87' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'resend_fvm_message',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@resend_fvm_message',
        'controller' => 'App\\Http\\Controllers\\VerificationController@resend_fvm_message',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::VpNYF6tEolGJCC87',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::t7JNsWRUBgkW5hBV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'group_order_form',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@group_order_form',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@group_order_form',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::t7JNsWRUBgkW5hBV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fe9R3TQSnZSt8DRr' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'create_group_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@create_group_order_customer',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@create_group_order_customer',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::fe9R3TQSnZSt8DRr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'group_orders' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'group_orders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@index',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'group_orders',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::smhOCoNygl2qmSSB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'change_zones_status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@change_zones_status',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@change_zones_status',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::smhOCoNygl2qmSSB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ou8yQnCmJmqMhxaY' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update_group_product',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@update_group_product',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@update_group_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Ou8yQnCmJmqMhxaY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2SO8cawvVobmQYnp' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_zones',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@get_zones',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@get_zones',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::2SO8cawvVobmQYnp',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::O9rMGXlf5OlaJwui' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_group_products',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@get_group_products',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@get_group_products',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::O9rMGXlf5OlaJwui',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FPXoKXuY5KIGQHCq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_group_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@get_group_order',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@get_group_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::FPXoKXuY5KIGQHCq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2ZTFjlZHSFrc0eOz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_active_group_products',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@get_active_group_products',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@get_active_group_products',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::2ZTFjlZHSFrc0eOz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NacWSbLyKYTbkCvH' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_active_zones',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@get_active_zones',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@get_active_zones',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::NacWSbLyKYTbkCvH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'confirmed_group_orders' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'confirmed_group_orders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@get_confirmed_group_orders',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@get_confirmed_group_orders',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'confirmed_group_orders',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jlqRO1cVZjxBkyRl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'send_group_order_mail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@send_group_order_mail',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@send_group_order_mail',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jlqRO1cVZjxBkyRl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FxHsiDO8U7iLipem' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'confirm_group',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@confirm_group_order',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@confirm_group_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::FxHsiDO8U7iLipem',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jJYrNAM9ZtsrRMHC' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'cancel_group',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@cancel_group_order',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@cancel_group_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jJYrNAM9ZtsrRMHC',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Zj23xclrc0KA6vqr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_group_items',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@get_group_items',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@get_group_items',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Zj23xclrc0KA6vqr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::q1HoX4vIb4N2hzO3' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'group_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@group_order_customer_page',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@group_order_customer_page',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::q1HoX4vIb4N2hzO3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mv2Q9p44HtkF4ymq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'left_group_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@left_group_order',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@left_group_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::mv2Q9p44HtkF4ymq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pTUS1QazhBkZuiqL' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'group_order_data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\GroupOrdersController@group_order_data',
        'controller' => 'App\\Http\\Controllers\\GroupOrdersController@group_order_data',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::pTUS1QazhBkZuiqL',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'orders_by_awb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'orders_by_awb',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@orders_by_awb',
        'controller' => 'App\\Http\\Controllers\\erp_controller@orders_by_awb',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'orders_by_awb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'verified' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verified',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@verified_orders',
        'controller' => 'App\\Http\\Controllers\\erp_controller@verified_orders',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'verified',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'on_process' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'on_process',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@on_process_orders',
        'controller' => 'App\\Http\\Controllers\\erp_controller@on_process_orders',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'on_process',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'fulfilled' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'fulfilled',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@fulfilled_orders',
        'controller' => 'App\\Http\\Controllers\\erp_controller@fulfilled_orders',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'fulfilled',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'tst' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tst',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@tst',
        'controller' => 'App\\Http\\Controllers\\erp_controller@tst',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'tst',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'archived' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'archived',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@archived',
        'controller' => 'App\\Http\\Controllers\\erp_controller@archived',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'archived',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::iAMjg2QC4rgXEXEF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'move_to_on_process',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@move_to_on_process',
        'controller' => 'App\\Http\\Controllers\\erp_controller@move_to_on_process',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::iAMjg2QC4rgXEXEF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sAGEnEneu0ddcdNK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'fulfill_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@mark_order_as_fulfilled',
        'controller' => 'App\\Http\\Controllers\\erp_controller@mark_order_as_fulfilled',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::sAGEnEneu0ddcdNK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7IQBufeHHmZ4CMGy' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'return_to_stock',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@return_to_stock',
        'controller' => 'App\\Http\\Controllers\\erp_controller@return_to_stock',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::7IQBufeHHmZ4CMGy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::fsgv7fVndDXM3IaW' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'erp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@excel_functions',
        'controller' => 'App\\Http\\Controllers\\erp_controller@excel_functions',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::fsgv7fVndDXM3IaW',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::uF7OwABNCt6t4UwZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cancel_confirmed',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@cancel_order_confirmed',
        'controller' => 'App\\Http\\Controllers\\VerificationController@cancel_order_confirmed',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::uF7OwABNCt6t4UwZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::w5eOxOcxBYx5BGqA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'cancel_tst',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@cancel_order_tst',
        'controller' => 'App\\Http\\Controllers\\VerificationController@cancel_order_tst',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::w5eOxOcxBYx5BGqA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::m2RObDqCzHVMmuar' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'return_to_confirmed',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@return_to_confirmed',
        'controller' => 'App\\Http\\Controllers\\VerificationController@return_to_confirmed',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::m2RObDqCzHVMmuar',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::CgD9LMfrxqLn3JyB' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'send_to_fct',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@send_to_fct',
        'controller' => 'App\\Http\\Controllers\\erp_controller@send_to_fct',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::CgD9LMfrxqLn3JyB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::PdfW109jcxbjlYSE' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'submit_tst',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@submit',
        'controller' => 'App\\Http\\Controllers\\erp_controller@submit',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::PdfW109jcxbjlYSE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pl8GsOUHEtxTrDTM' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'search_tst_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@search_orders_result_tst',
        'controller' => 'App\\Http\\Controllers\\erp_controller@search_orders_result_tst',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::pl8GsOUHEtxTrDTM',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'bulk' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bulk',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@tst',
        'controller' => 'App\\Http\\Controllers\\erp_controller@tst',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'bulk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AFGSUAVyfVfkVo8j' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'export_tst',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@export_tst',
        'controller' => 'App\\Http\\Controllers\\erp_controller@export_tst',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::AFGSUAVyfVfkVo8j',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OsPYdYMXXgNmeIQS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'export_archived',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@export_archived',
        'controller' => 'App\\Http\\Controllers\\erp_controller@export_archived',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::OsPYdYMXXgNmeIQS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::z3Qd4p5JMPEweZom' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'submit_awb_data',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@submit_awb_data',
        'controller' => 'App\\Http\\Controllers\\erp_controller@submit_awb_data',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::z3Qd4p5JMPEweZom',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::11zpwHmyoJit8Apt' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'remove_from_awbs',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@remove_from_awbs',
        'controller' => 'App\\Http\\Controllers\\erp_controller@remove_from_awbs',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::11zpwHmyoJit8Apt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jHZjRZHyT3xKiD9p' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'get_similar_item',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@get_similar_item',
        'controller' => 'App\\Http\\Controllers\\StockController@get_similar_item',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::jHZjRZHyT3xKiD9p',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::b49aOs6UUIPcO3r2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'return_qty_to_stock',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@return_qty_to_stock',
        'controller' => 'App\\Http\\Controllers\\StockController@return_qty_to_stock',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::b49aOs6UUIPcO3r2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NOaZmBEHY2y9NGFI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'create_new_variant',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@create_new_variant',
        'controller' => 'App\\Http\\Controllers\\StockController@create_new_variant',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::NOaZmBEHY2y9NGFI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vdsgzyGbPd7vipW4' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'create_new_product_return',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\StockController@create_new_return_product',
        'controller' => 'App\\Http\\Controllers\\StockController@create_new_return_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::vdsgzyGbPd7vipW4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'fct' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'fct',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@fct',
        'controller' => 'App\\Http\\Controllers\\erp_controller@fct',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'fct',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'fct_archived' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'archived_fct',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@fct_archived',
        'controller' => 'App\\Http\\Controllers\\erp_controller@fct_archived',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'fct_archived',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::YNWWtumx2s5Hhr4p' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'submit_fct',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@submit_fct',
        'controller' => 'App\\Http\\Controllers\\erp_controller@submit_fct',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::YNWWtumx2s5Hhr4p',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::qaatAtv50gA6RrUm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'search_fct',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@search_fct',
        'controller' => 'App\\Http\\Controllers\\erp_controller@search_fct',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::qaatAtv50gA6RrUm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::maGalCCT0CM40b1h' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'assign_task',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@assign_task',
        'controller' => 'App\\Http\\Controllers\\erp_controller@assign_task',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::maGalCCT0CM40b1h',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'tasks' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tasks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@get_tasks',
        'controller' => 'App\\Http\\Controllers\\erp_controller@get_tasks',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'tasks',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RIcwOqjr0PZWJI7A' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'get_users',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@get_users',
        'controller' => 'App\\Http\\Controllers\\erp_controller@get_users',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::RIcwOqjr0PZWJI7A',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'tasks_archived' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'archived_tasks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@get_archived_tasks',
        'controller' => 'App\\Http\\Controllers\\erp_controller@get_archived_tasks',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'tasks_archived',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'assigned' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'assigned_tasks',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@get_assigned_tasks',
        'controller' => 'App\\Http\\Controllers\\erp_controller@get_assigned_tasks',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'assigned',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::UZ6bCiqkfGGgnmqV' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'new_currency',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@new_currency',
        'controller' => 'App\\Http\\Controllers\\HomeController@new_currency',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::UZ6bCiqkfGGgnmqV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kW2rGlma6lrafLwl' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'add_task',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@add_task',
        'controller' => 'App\\Http\\Controllers\\erp_controller@add_task',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::kW2rGlma6lrafLwl',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::K5baAGvYcVSRrnAD' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'get_currency',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@get_country_currency',
        'controller' => 'App\\Http\\Controllers\\HomeController@get_country_currency',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::K5baAGvYcVSRrnAD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::G2zQDR6X0ByODZrI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'task_status',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@update_task_status',
        'controller' => 'App\\Http\\Controllers\\erp_controller@update_task_status',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::G2zQDR6X0ByODZrI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oHmMloHE4QisSs1F' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'assign_reply',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@assign_reply',
        'controller' => 'App\\Http\\Controllers\\erp_controller@assign_reply',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::oHmMloHE4QisSs1F',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::upRC9q1HKu7CIZb9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'task_details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\erp_controller@task_details',
        'controller' => 'App\\Http\\Controllers\\erp_controller@task_details',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::upRC9q1HKu7CIZb9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2rq3FTsZ5K0i5DE4' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'emails',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:272:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:54:"function () {
    return \\view(\'emails_response\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000006cb0000000000000000";}";s:4:"hash";s:44:"qgLo1TCNzPW1xaXD7bD61kwIf8xCWu3xBRyS5zvZVvc=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::2rq3FTsZ5K0i5DE4',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::euU7Flhe6r6Pk8XB' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'staff_bulk_awb',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\DomesticController@staff_bulk_awb',
        'controller' => 'App\\Http\\Controllers\\DomesticController@staff_bulk_awb',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::euU7Flhe6r6Pk8XB',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::meg4NVj5HGiDziFF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'awb_bulk_upload_express',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\DomesticController@awb_bulk_upload_express',
        'controller' => 'App\\Http\\Controllers\\DomesticController@awb_bulk_upload_express',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::meg4NVj5HGiDziFF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9fYWFwVYxMLOhL7T' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'get_country_cities',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'client',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@get_country_cities',
        'controller' => 'App\\Http\\Controllers\\ClientController@get_country_cities',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::9fYWFwVYxMLOhL7T',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BfSAnUPcOqvDzEb9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'send_shipper_info',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@send_shipper_info',
        'controller' => 'App\\Http\\Controllers\\ClientController@send_shipper_info',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::BfSAnUPcOqvDzEb9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VAirEr1ypY8ifJCm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'create_new_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'client',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@create_new_order',
        'controller' => 'App\\Http\\Controllers\\ClientController@create_new_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::VAirEr1ypY8ifJCm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::M5yqGiDsLI6JVl3k' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'scan_barcode',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@scan_barcode',
        'controller' => 'App\\Http\\Controllers\\ClientController@scan_barcode',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::M5yqGiDsLI6JVl3k',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::zBDEkSrXsqlQBnLE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'under_review',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@under_review',
        'controller' => 'App\\Http\\Controllers\\ClientController@under_review',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::zBDEkSrXsqlQBnLE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'new_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'client',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@new_order',
        'controller' => 'App\\Http\\Controllers\\ClientController@new_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'create',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'shipments' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'shippment_list',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'client',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@shippment_list',
        'controller' => 'App\\Http\\Controllers\\ClientController@shippment_list',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'shipments',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::TVZNn6Ix2zC9yhrq' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'client',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@profile',
        'controller' => 'App\\Http\\Controllers\\ClientController@profile',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::TVZNn6Ix2zC9yhrq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::EbbXRxiTadMOKS7Q' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'delete_shipment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'client',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@delete_client_shipment',
        'controller' => 'App\\Http\\Controllers\\ClientController@delete_client_shipment',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::EbbXRxiTadMOKS7Q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::22YlvLW5F9Nc1Q0N' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'track/shipment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@track_shipment',
        'controller' => 'App\\Http\\Controllers\\ClientController@track_shipment',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::22YlvLW5F9Nc1Q0N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kQQ1fvszxH1uJm8s' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'add_claim',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@add_claim',
        'controller' => 'App\\Http\\Controllers\\ClientController@add_claim',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::kQQ1fvszxH1uJm8s',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'scan_barcodes' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'scanBarcodes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@scanBarcodes',
        'controller' => 'App\\Http\\Controllers\\ClientController@scanBarcodes',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'scan_barcodes',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'warehouse' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'shipments_managment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@shipmments_client',
        'controller' => 'App\\Http\\Controllers\\ClientController@shipmments_client',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'warehouse',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'pending_shipments' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'pending_shipments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@get_shipments',
        'controller' => 'App\\Http\\Controllers\\ClientController@get_shipments',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'pending_shipments',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'create_awb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'client_shipment_awb',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@create_awb',
        'controller' => 'App\\Http\\Controllers\\ClientController@create_awb',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'create_awb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'create_bulk_awb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'client_bulk_shipment_awb',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@create_awb_by_bulk',
        'controller' => 'App\\Http\\Controllers\\ClientController@create_awb_by_bulk',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'create_bulk_awb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IWbHzHbg7D3PUN0I' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'awb_bulk_upload',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@awb_bulk_upload',
        'controller' => 'App\\Http\\Controllers\\ClientController@awb_bulk_upload',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::IWbHzHbg7D3PUN0I',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::84snJLiXJb0uplaX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'submit_barcodes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@submit_barcodes',
        'controller' => 'App\\Http\\Controllers\\ClientController@submit_barcodes',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::84snJLiXJb0uplaX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hJc0DEdBc54tXIxF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'submit_dispatch',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@submit_dispatch',
        'controller' => 'App\\Http\\Controllers\\ClientController@submit_dispatch',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::hJc0DEdBc54tXIxF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cZvwaBe6VpQuHx3G' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'generate_awb',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@generate_awb',
        'controller' => 'App\\Http\\Controllers\\ClientController@generate_awb',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::cZvwaBe6VpQuHx3G',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::lm7cpNhoC7hjv2Kh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'download_awb',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@download_awb',
        'controller' => 'App\\Http\\Controllers\\ClientController@download_awb',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::lm7cpNhoC7hjv2Kh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'accounts' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'accounts_managment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@accounts_managment',
        'controller' => 'App\\Http\\Controllers\\ClientController@accounts_managment',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'accounts',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LWfOpdU70bPXnbVq' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'toggle_active',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@toggle_users_active',
        'controller' => 'App\\Http\\Controllers\\ClientController@toggle_users_active',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::LWfOpdU70bPXnbVq',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::sILxUmOFvkSfpDl6' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'scanBarcodes_details',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@scanBarcodes_details',
        'controller' => 'App\\Http\\Controllers\\ClientController@scanBarcodes_details',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::sILxUmOFvkSfpDl6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::F1fAzwnKjcIWOiVD' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'search_shipment',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@search_shipment_result',
        'controller' => 'App\\Http\\Controllers\\ClientController@search_shipment_result',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::F1fAzwnKjcIWOiVD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'vendors' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'vendors_shipments',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@vendors_shipments',
        'controller' => 'App\\Http\\Controllers\\ClientController@vendors_shipments',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'vendors',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kBFfrC99bgC7Y0Ra' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'mohsen',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:256:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:38:"function () {
    return \'mohsen\';
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000006e90000000000000000";}";s:4:"hash";s:44:"MccpvH6LHvh8vHBbjZX9bKn9mzXIJzjBcWB2/L0s1HM=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::kBFfrC99bgC7Y0Ra',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3TUftsrjMrnRsPfT' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'import_file',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@import',
        'controller' => 'App\\Http\\Controllers\\ClientController@import',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::3TUftsrjMrnRsPfT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::hYQ5KmueArRzRAtX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'user_url',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@insert_user_url',
        'controller' => 'App\\Http\\Controllers\\ClientController@insert_user_url',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::hYQ5KmueArRzRAtX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'upload' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'upload_orders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'client',
        ),
        'uses' => 'App\\Http\\Controllers\\ClientController@get_upload_orders_page',
        'controller' => 'App\\Http\\Controllers\\ClientController@get_upload_orders_page',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'upload',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kPxqjPBBKHAnqm4P' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'import_excel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportExcelController@index',
        'controller' => 'App\\Http\\Controllers\\ImportExcelController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::kPxqjPBBKHAnqm4P',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cTWMlYsifgzHNGeR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'import_excel/import',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportExcelController@import',
        'controller' => 'App\\Http\\Controllers\\ImportExcelController@import',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::cTWMlYsifgzHNGeR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3vsrVkw7XjDVxF9r' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'import_excel/aramex',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportExcelController@aramex',
        'controller' => 'App\\Http\\Controllers\\ImportExcelController@aramex',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::3vsrVkw7XjDVxF9r',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NZicBXrpfdiMYkeS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'import_excel/product',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\ImportExcelController@product',
        'controller' => 'App\\Http\\Controllers\\ImportExcelController@product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::NZicBXrpfdiMYkeS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::cgawUSXqXYXoThEK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'tracking/{kshopina_tracking}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\TrackingController@index',
        'controller' => 'App\\Http\\Controllers\\TrackingController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::cgawUSXqXYXoThEK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0bmtQA5f9RNHAfFE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'QRcodes',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@index',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::0bmtQA5f9RNHAfFE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::420tp2kQAXDZYCXt' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'generate',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@generate',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@generate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::420tp2kQAXDZYCXt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yAfHxQWJJLSizydE' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'scan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@scan',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@scan',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::yAfHxQWJJLSizydE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vgo77fV88f1uIdpK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'wrong',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@wrong_access',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@wrong_access',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::vgo77fV88f1uIdpK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VasKFBVDkrG1evHc' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'refused_orders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\RefusedController@index',
        'controller' => 'App\\Http\\Controllers\\RefusedController@index',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::VasKFBVDkrG1evHc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::i2yWMEdjdtVBz3NU' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'delivered',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@delivered',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@delivered',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::i2yWMEdjdtVBz3NU',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::HOjggev9zECQzSN5' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'delivered_process',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@delivered_process',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@delivered_process',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::HOjggev9zECQzSN5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vDjZiUSSsZcBD3yK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'wrongPhone',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@wrongPhone',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@wrongPhone',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::vDjZiUSSsZcBD3yK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SZoBhZXyGpis9nAz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'refused',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@refused',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@refused',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::SZoBhZXyGpis9nAz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Y3BVFWTSkkx1EP1n' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'refused_process',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@refused_process',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@refused_process',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Y3BVFWTSkkx1EP1n',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2abPbNmFhdWTbHDv' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'refused_cancel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@refused_cancel',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@refused_cancel',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::2abPbNmFhdWTbHDv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::k0pFytmF2lCy9usr' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'contact_support',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@contact_support',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@contact_support',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::k0pFytmF2lCy9usr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WBQf5aQoqhUpMPJV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'requests',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@requests',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@requests',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::WBQf5aQoqhUpMPJV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::QDNPHAQjQyb37Smj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'support_change',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\QrCodesController@support_change',
        'controller' => 'App\\Http\\Controllers\\QrCodesController@support_change',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::QDNPHAQjQyb37Smj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dtjb9q6ae4PRB3uJ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'fulfilment_placed_on_hold',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@fulfilment_placed_on_hold',
        'controller' => 'App\\Http\\Controllers\\WebhookController@fulfilment_placed_on_hold',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::dtjb9q6ae4PRB3uJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JhE0ujAtzAZnUky0' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'fulfilment_hold_release',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@fulfilment_hold_release',
        'controller' => 'App\\Http\\Controllers\\WebhookController@fulfilment_hold_release',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::JhE0ujAtzAZnUky0',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::kWyCq2GlqF31lMnb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'order_edited_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@order_edited_webhook',
        'controller' => 'App\\Http\\Controllers\\WebhookController@order_edited_webhook',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::kWyCq2GlqF31lMnb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VdNho6eqa3tbGMnh' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'all_manual_create_new_order',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@origin_manual_create_new_shopify_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@origin_manual_create_new_shopify_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::VdNho6eqa3tbGMnh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RRxnF0tOglIrJ7Bw' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'egypt_order_create_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@all_create_new_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@all_create_new_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::RRxnF0tOglIrJ7Bw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GoqAeWG2oJ7ISr4e' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'egypt_order_cancelled_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@egypt_cancelled_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@egypt_cancelled_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::GoqAeWG2oJ7ISr4e',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0LgVBY0zmwzUhbWE' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'egypt_order_paid_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@egypt_paid_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@egypt_paid_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::0LgVBY0zmwzUhbWE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3VndR4uPhTZDAYmw' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'egypt_order_updated_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@order_edited',
        'controller' => 'App\\Http\\Controllers\\WebhookController@order_edited',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::3VndR4uPhTZDAYmw',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9hQtolSlkz0Xx4pA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'egypt_product_new_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_add_new_product',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_add_new_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::9hQtolSlkz0Xx4pA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3nLwC5HiAGfxftJX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'egypt_product_updated_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_product_updated',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_product_updated',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::3nLwC5HiAGfxftJX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::t3JsNczpntDiqedX' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'egypt_product_delete_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_delete_product',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_delete_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::t3JsNczpntDiqedX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Zt4OYERq5V888zaz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'origin_order_create_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@all_create_new_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@all_create_new_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Zt4OYERq5V888zaz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::nVfyvZRrCVHnrVbf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'origin_order_updated_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@origin_order_edited',
        'controller' => 'App\\Http\\Controllers\\WebhookController@origin_order_edited',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::nVfyvZRrCVHnrVbf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::i81UNWLWEIeWclR9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'origin_order_cancelled_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@origin_cancelled_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@origin_cancelled_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::i81UNWLWEIeWclR9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::A4SUl5IB5E47Bd2N' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'origin_order_paid_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@origin_paid_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@origin_paid_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::A4SUl5IB5E47Bd2N',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7jhUnzfvDLL3r8tk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'origin_product_new_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_add_new_product',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_add_new_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::7jhUnzfvDLL3r8tk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::utBgCJpcn7sb6iNH' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'origin_product_updated_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_product_updated',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_product_updated',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::utBgCJpcn7sb6iNH',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::6xLquhTuofsERL07' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'origin_product_delete_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_delete_product',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_delete_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::6xLquhTuofsERL07',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::K6KCWBdwOxU87TNg' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ksa_order_create_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@all_create_new_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@all_create_new_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::K6KCWBdwOxU87TNg',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::H6Pv8J6chOu5NVZ2' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ksa_order_updated_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@ksa_order_edited',
        'controller' => 'App\\Http\\Controllers\\WebhookController@ksa_order_edited',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::H6Pv8J6chOu5NVZ2',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::tD43VbwlaDT09Fdh' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ksa_order_cancelled_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_cancelled_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_cancelled_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::tD43VbwlaDT09Fdh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::q7Sc6AjNan5NluZb' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ksa_order_paid_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_paid_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_paid_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::q7Sc6AjNan5NluZb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Jlz3cF8bcZW1Rhxs' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ksa_product_new_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_add_new_product',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_add_new_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::Jlz3cF8bcZW1Rhxs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::9o1XnzJpe2YDFJSP' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ksa_product_updated_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_product_updated',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_product_updated',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::9o1XnzJpe2YDFJSP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::mKay7SBQ8ntYvRta' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ksa_product_delete_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_delete_product',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_delete_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::mKay7SBQ8ntYvRta',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MiB0Yhk3u91UX8GZ' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'kuwait_order_create_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@all_create_new_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@all_create_new_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::MiB0Yhk3u91UX8GZ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::3uv3vM8zI7PhKBDA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'kuwait_order_cancelled_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_cancelled_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_cancelled_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::3uv3vM8zI7PhKBDA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4mBM3x9VC2gygFGd' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'kuwait_order_paid_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_paid_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_paid_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::4mBM3x9VC2gygFGd',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::KdGEUPlo0gNKPdI9' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'kuwait_product_new_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_add_new_product',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_add_new_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::KdGEUPlo0gNKPdI9',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XfWaE953yMAjq9GF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'kuwait_product_updated_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_product_updated',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_product_updated',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::XfWaE953yMAjq9GF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::yYjksTYGKgSjexpi' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'kuwait_product_delete_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_delete_product',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_delete_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::yYjksTYGKgSjexpi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WjjGW9wqj2qXrEzz' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'uae_order_create_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@all_create_new_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@all_create_new_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::WjjGW9wqj2qXrEzz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::E45ZtyLbFy7qHOHE' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'uae_order_cancelled_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_cancelled_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_cancelled_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::E45ZtyLbFy7qHOHE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5hCHmY404gC12J0h' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'uae_order_paid_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_paid_order',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_paid_order',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::5hCHmY404gC12J0h',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::AfJ5sOKAfCWh9PoG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'uae_product_new_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_add_new_product',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_add_new_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::AfJ5sOKAfCWh9PoG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5MSkkiiPAy1cxTbF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'uae_product_updated_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_product_updated',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_product_updated',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::5MSkkiiPAy1cxTbF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WiKsfqBl1Es9mpYy' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'uae_product_delete_webhook',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WebhookController@plus_delete_product',
        'controller' => 'App\\Http\\Controllers\\WebhookController@plus_delete_product',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::WiKsfqBl1Es9mpYy',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0Y0gwa2edPGK4zdn' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'whatsapp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WhatsAppController@whatsapp',
        'controller' => 'App\\Http\\Controllers\\WhatsAppController@whatsapp',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::0Y0gwa2edPGK4zdn',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7GmO7qMR5qiBHeLf' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'whatsapp',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WhatsAppController@whatsapp_webhooks',
        'controller' => 'App\\Http\\Controllers\\WhatsAppController@whatsapp_webhooks',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::7GmO7qMR5qiBHeLf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::LYGCmsib5sk6aRuJ' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'whatsapp_send_msg',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\WhatsAppController@whatsapp_send_message',
        'controller' => 'App\\Http\\Controllers\\WhatsAppController@whatsapp_send_message',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::LYGCmsib5sk6aRuJ',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oo2I3m2NrzuYqeyX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'something',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'auth',
          2 => 'staff',
        ),
        'uses' => 'App\\Http\\Controllers\\VerificationController@something',
        'controller' => 'App\\Http\\Controllers\\VerificationController@something',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::oo2I3m2NrzuYqeyX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::v9CkDo7i8H0aKIjE' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'UpdateTrackingStatus',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\TrackingUpdateController@update_tracking_status',
        'controller' => 'App\\Http\\Controllers\\TrackingUpdateController@update_tracking_status',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::v9CkDo7i8H0aKIjE',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
