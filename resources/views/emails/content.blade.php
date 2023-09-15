@component('mail::message')
# New Content Available

Hello,

We have new content available for you.

**Title**: {{ $content->title }}

**Message**:

{{!! ($content->message) !!}}

Thank you for using our service.

@endcomponent
