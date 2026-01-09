<x-mail::message>
# Email Requisition Submitted

Hello {{ $requisition->full_name }},

Your email requisition has been successfully submitted and is currently awaiting approval from your Department Head.

**Details:**
- **Requisition Date:** {{ $requisition->requisition_date }}
- **Request Type:** {{ $requisition->request_type }}
- **Department:** {{ $requisition->department }}

We will notify you once your request has been processed.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>