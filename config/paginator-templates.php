<?php

return [
    'first' => '<li class="page-item"><a class="page-link" aria-label="First" href="{{url}}">{{text}}</a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="#">{{text}}</a></li>',
    'nextActive' => '<li class="page-item"><a class="page-link" aria-label="Next" href="{{url}}">{{text}}</a></li>',
    'nextDisabled' => '<li class="page-item disabled"><a class="page-link text-muted" aria-label="Next"><span aria-hidden="true">{{text}}</span></a></li>',
    'prevActive' => '<li class="page-item"><a class="page-link" aria-label="Previous" href="{{url}}">{{text}}</a></li>',
    'prevDisabled' => '<li class="page-item disabled"><a class="page-link text-muted" aria-label="Previous"><span aria-hidden="true">{{text}}</span></a></li>',
    'last' => '<li class="page-item"><a class="page-link" aria-label="Last" href="{{url}}">{{text}}</a></li>',
];