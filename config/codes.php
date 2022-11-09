<?php

return 
[
    'site' => 
    [
        
    ],
    'access_rule' =>
    [        
        'check_age' => 
        [
            0 => "無年齡限制",
            1 => "限成年者"
        ],
        'single_pass' => 
        [
            0 => "可重複入場",
            1 => "限單次入場"
        ]
    ],
    'card_reader' => 
    [
        'usage' => 
        [
            0 => '櫃臺',
            1 => '入場管理',
            2 => '加扣點數'
        ]
    ],
    'attendee' =>
    [
        'type' => 
        [
            'A' => '超級',
            'B' => '特別',
            'C' => '一般',
            'D' => '現場',
            'V' => '特邀',
            'Z' => 'Staff'
        ]
    ]

];
