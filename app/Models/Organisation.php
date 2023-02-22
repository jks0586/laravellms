<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Organisation extends Model
{
    use HasFactory;
    protected $appends = ['action'];
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';
    protected $table='organisation';
    protected $fillable = [
        'name',
        'url',
        'from_email',
        'identity_verification_email',
        'parent_organisation_id',
        'active'=>'nullable|boolean',
        'use_organisation_structure',
        'use_usi',
        'use_staff_id',
        'time_zone',
        'eway_customer_id',
        'enable_eway',
        'enable_stripe',
        'eway_test_mode',
        'email_template',
        'logo',
        'background_image',
        'background_position',
        'background_repeat',
        'background_size',
        'background_color',
        'print_logo',
        'footer_text',
        'eway_user_name',
        'stripe_secret_key',
        'stripe_publishable_key',
        'trial_end',
        'restrict_by_ip',
        'terms_and_conditions',
        'identity_requirements',
        'welcome_email',
        'course_complete_email',
        'invoice_address',
        'new_course_email',
        'set_password_email',
        'invoice_thankyou_message',
        'avetmiss_privacy_notice'
    ];

    public function getActionAttribute()
    {
        if(!empty($this->id)){

            return '<a href="'.route('lms.organisation.edit',$this->id).'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
            <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
            <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
            </svg>
            </a>';
        } else {
            return false;
        }
    }
}
