<?php

namespace App\Utils;

enum DateFormats: string
{
    case DATE = 'Y-m-d';
    case DATE_BR = 'd/m/Y';
    case DATETIME_LOCAL = 'Y-m-d\TH:i';
}
