<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSetting extends Model
{
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table='course_setting';
    protected $fillable = [
        'organisation_id',
        'course_id',
        'price',
        'wholesale_price',
        'tax',
        'free_with_referral',
        'visible',
        'weight',
        'downloadable_assessments',
        'require_identification',
        'editable_id_verification',
        'time_to_complete',
        'custom_welcome_email',
        'welcome_email_subject',
        'welcome_email',
        'assessment_pdf_cover_page',
        'not_yet_competent_message',
        'completion_message',
        'completion_subject',
        'image',
        'course_expiry_charge',
    ];
    use HasFactory;

}
