<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<style>

.btn {
    box-sizing: border-box;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
    position: relative;
    -webkit-text-size-adjust: none;
    border-radius: 4px;
    display: inline-block;
    overflow: hidden;
    text-decoration: none;
}

.btn-primary {
    color: #fff;
    background-color: #007bff;
    border-bottom: 8px solid #007bff;
    border-left: 18px solid #007bff;
    border-right: 18px solid #007bff;
    border-top: 8px solid #007bff;
}

.btn-orange {
    color: #fff;
    background-color: #CA6D00;
    border-bottom: 8px solid #CA6D00;
    border-left: 18px solid #CA6D00;
    border-right: 18px solid #CA6D00;
    border-top: 8px solid #CA6D00;
}

.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}

@media only screen and (max-width: 600px) {
.inner-body {
width: 100% !important;
}

.footer {
width: 100% !important;
}
}

@media only screen and (max-width: 500px) {
.button {
width: 100% !important;
}
}
</style>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #131A26;">
<tr>
<td align="center">
<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
{{ $header ?? '' }}

<!-- Email Body -->
<tr>
<td class="body" width="100%" cellpadding="0" cellspacing="0" style="background-color: #131A26; border-bottom: 0px; border-top: 0px;">
<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<!-- Body content -->
<tr>
<td class="content-cell">
{{ Illuminate\Mail\Markdown::parse($slot) }}

{{ $subcopy ?? '' }}
</td>
</tr>
</table>
</td>
</tr>

{{ $footer ?? '' }}
</table>
</td>
</tr>
</table>
</body>
</html>
