<x-mail::message>
# Email Requisition Fulfilled

Hello {{ $requisition->full_name }},

Your email requisition has been fulfilled and approved by the IT Department.

**Your Email Details:**
- **Email Address:** {{ $requisition->email_address }}
- **Password:** {{ $requisition->password }}

**Other Details:**
- **Creation Date:** {{ $requisition->email_creation_date }}
- **Distribution List:** {{ $requisition->distribution_list_final }}

Please change your password after your first login.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>