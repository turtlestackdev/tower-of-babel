<?php

namespace TowerOfBabel\Forms;

enum FieldType: string {
    case Text = 'text';
    case TextArea = 'textarea';
    case Select = 'select';
    case CheckBox = 'checkbox';
    case Radio = 'radio';
    case Color = 'color';
    case Date = 'date';
    case DateTime = 'datetime-local';
    case Email = 'email';
    case File = 'file';
    case Hidden = 'hidden';
    case Image = 'image';
    case Month = 'month';
    case Number = 'number';
    case Password = 'password';
    case Range = 'range';
    case Reset = 'reset';
    case Search = 'search';
    case Submit = 'submit';
    case Phone = 'tel';
    case Time = 'time';
    case URL = 'url';
    case Week = 'week';
}
