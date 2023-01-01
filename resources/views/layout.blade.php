<!DOCTYPE html>
<html lang="{{ trans('global-variable:base.lang') }}"@if(trans('global-variable:base.direction') == 'rtl') direction="rtl" style="direction: rtl;"@endif>
<head>
    {!! GlobalVariable::document()->getHeader() !!}
    @yield('style')

</head>
<body class="{{ GlobalVariable::document()->getBodyClass() }}">
    @yield('content')
    {!! GlobalVariable::document()->getFooter() !!}
    @yield('script')

</body>
</html>
