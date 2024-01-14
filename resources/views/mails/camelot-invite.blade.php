@php
    $candidate = \App\Models\CamelotCandidate::find($mailData['candidate_id']);
    //$candidate = $mailData->candidate;
    $branch = \App\Models\Branch::find($mailData['branch_id']);
    //$branch = $mailData->branch;
    $password=$mailData['password'];
@endphp
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="x-apple-disable-message-reformatting" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<style type="text/css">
    body, .maintable { height:100% !important; width:100% !important; margin:0; padding:0;}
    img, a img { border:0; outline:none; text-decoration:none;}
    p {margin-top:0; margin-right:0; margin-left:0; padding:0;}
    .ReadMsgBody {width:100%;}
    .ExternalClass {width:100%;}
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height:100%;}
    img {-ms-interpolation-mode: bicubic;}
    body, table, td, p, a, li, blockquote {-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
</style>
<style type="text/css">
@media only screen and (max-width: 792px) {
 .rtable {width: 100% !important;}
 .rtable tr {height:auto !important; display: block;}
 .contenttd {max-width: 100% !important; display: block; width: auto !important;}
 .contenttd:after {content: ""; display: table; clear: both;}
 .hiddentds {display: none;}
 .imgtable, .imgtable table {max-width: 100% !important; height: auto; float: none; margin: 0 auto;}
 .imgtable.btnset td {display: inline-block;}
 .imgtable img {width: 100%; height: auto !important;display: block;}
 table {float: none;}
 .mobileHide {display: none !important;}
}
</style>
<!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
</head>
<body style="overflow: auto; padding:0; margin:0; font-size: 14px; font-family: arial, helvetica, sans-serif; cursor:auto; background-color:#feffff">
<table cellspacing="0" cellpadding="0" width="100%" bgcolor="#feffff">
<tr>
<td style="FONT-SIZE: 0px; HEIGHT: 0px; LINE-HEIGHT: 0"></td>
</tr>
<tr>
<td valign="top">
<table class="rtable" style="WIDTH: 792px; MARGIN: 0px auto" cellspacing="0" cellpadding="0" width="792" align="center" border="0">
<tr>
<th class="contenttd" style="BORDER-TOP: #feffff 5px solid; BORDER-RIGHT: medium none; WIDTH: 792px; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff">
<table style="WIDTH: 100%" cellspacing="0" cellpadding="0" align="left">
<tr style="HEIGHT: 40px" height="40">
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 762px; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent"></th>
</tr>
</table>
</th>
</tr>
<tr>
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 792px; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff">
<table style="WIDTH: 100%" cellspacing="0" cellpadding="0" align="left">
<tr style="HEIGHT: 180px" height="180">
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 762px; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 1px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent"><!--[if gte mso 12]>
    <table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td align="center">
<![endif]-->
<table class="imgtable" style="MARGIN: 0px auto" cellspacing="0" cellpadding="0" align="center" border="0">
<tr>
<td style="PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px" align="center">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent"><img style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block" alt="" src="{{config('app.url')}}/images/mail-invite/Image_1_73379744-79c3-4f8c-bf51-b1b1104cee7c.png" width="733" hspace="0" vspace="0" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--><!--[if gte mso 12]>
    <table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td align="center">
<![endif]-->
<table class="imgtable" style="MARGIN: 0px auto" cellspacing="0" cellpadding="0" align="center" border="0">
<tr>
<td style="PADDING-BOTTOM: 2px; PADDING-TOP: 2px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px" align="center">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent"><img style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block" alt="" src="{{config('app.url')}}/images/mail-invite/Image_2_5fe0ae9c-8cb2-4068-a444-9b434781bfa3.png" width="758" hspace="0" vspace="0" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
</tr>
</table>
</th>
</tr>
<tr>
<th class="contenttd" style="BORDER-TOP: #feffff 5px solid; BORDER-RIGHT: medium none; WIDTH: 792px; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff">
<table style="WIDTH: 100%" cellspacing="0" cellpadding="0" align="left">
<tr style="HEIGHT: 369px" height="369">
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 762px; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent">
<p style="FONT-SIZE: 24px; MARGIN-BOTTOM: 1em; FONT-FAMILY: geneve, arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; TEXT-ALIGN: justify; LINE-HEIGHT: 37px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align="justify"><strong>Unisciti</strong> a Camelot: <strong>&egrave; gratis!</strong></p>
<p style="FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: geneve, arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; TEXT-ALIGN: left; LINE-HEIGHT: 25px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align="left">Ciao {{$candidate->name}},<br />
Abbiamo una notizia stupenda: non vogliamo solo aiutarti con la formazione, vogliamo anche farti avere il lavoro che desideri. Per questo ci siamo uniti a Camelot.</p>
<p style="FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: geneve, arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; TEXT-ALIGN: left; LINE-HEIGHT: 25px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align="left">Non avrai curriculum da scrivere, n&eacute; annunci da leggere. Ti basta completare il profilo ed indicare il lavoro dei tuoi sogni: al resto ci pensa Camelot.</p>
<p style="FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: geneve, arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; TEXT-ALIGN: left; LINE-HEIGHT: 25px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align="left">Vuoi lasciartela scappare?<br />
Le occasioni vanno colte al volo.</p>
<p style="FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: geneve, arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; TEXT-ALIGN: left; LINE-HEIGHT: 25px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align="left"><strong>Accedi e unisciti anche tu a Camelot</strong></p>
</th>
</tr>
</table>
</th>
</tr>
<tr>
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 792px; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff">
<table style="WIDTH: 100%" cellspacing="0" cellpadding="0" align="left">
<tr style="HEIGHT: 170px" height="170">
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 372px; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent"><!--[if gte mso 12]>
    <table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td align="center">
<![endif]-->
<table class="imgtable" style="MARGIN: 0px auto" cellspacing="0" cellpadding="0" align="center" border="0">
<tr>
<td style="PADDING-BOTTOM: 5px; PADDING-TOP: 5px; PADDING-LEFT: 5px; PADDING-RIGHT: 5px" align="center">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent"><img style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block" alt="" src="{{config('app.url')}}/images/mail-invite/Image_3_16d863f9-4546-475a-a68e-5c8910b02819.png" width="362" hspace="0" vspace="0" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]-->
<p style="FONT-SIZE: 24px; MARGIN-BOTTOM: 1em; FONT-FAMILY: geneve, arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #2d2d2d; TEXT-ALIGN: left; LINE-HEIGHT: 37px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align="left">&nbsp;</p>
</th>
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 380px; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 5px; TEXT-ALIGN: left; PADDING-TOP: 5px; PADDING-LEFT: 5px; BORDER-LEFT: medium none; PADDING-RIGHT: 5px; BACKGROUND-COLOR: transparent"><!--[if gte mso 12]>
    <table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td align="center">
<![endif]-->
<table class="imgtable" style="MARGIN: 0px auto" cellspacing="0" cellpadding="0" align="center" border="0">
<tr>
<td style="PADDING-BOTTOM: 2px; PADDING-TOP: 5px; PADDING-LEFT: 2px; PADDING-RIGHT: 2px" align="center">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent"><a target="_blank" rel="noopener noreferrer" href="{{config('constants.camelot_webapp_url')}}/partnership_login?name={{$candidate->name}}&email={{$candidate->email}}&password={{$password}}"><img style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block" alt="" src="{{config('app.url')}}/images/mail-invite/Image_4_2c32f1f4-ef03-48cc-873d-cb5e28455355.png" width="362" hspace="0" vspace="0" /></a></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]--></th>
</tr>
</table>
</th>
</tr>
<tr>
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 792px; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #feffff">
<table style="WIDTH: 100%" cellspacing="0" cellpadding="0" align="left">
<tr style="HEIGHT: 81px" height="81">
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 762px; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 20px; TEXT-ALIGN: left; PADDING-TOP: 20px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: transparent">
<p style="FONT-SIZE: 16px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #575757; TEXT-ALIGN: center; LINE-HEIGHT: 25px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align="center"><strong>Camelot & {{$branch->cfp->name}}, insieme per darti sempre il meglio.</strong></p>
</th>
</tr>
</table>
</th>
</tr>
<tr>
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 792px; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 10px; TEXT-ALIGN: left; PADDING-TOP: 10px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent">
<table style="WIDTH: 100%" cellspacing="0" cellpadding="0" align="left">
<tr style="HEIGHT: 290px" height="290">
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 792px; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 0px; TEXT-ALIGN: left; PADDING-TOP: 0px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: #2d2d2d"><!--[if gte mso 12]>
    <table cellspacing="0" cellpadding="0" border="0" width="100%"><tr><td align="center">
<![endif]-->
<table class="imgtable" style="MARGIN: 0px auto" cellspacing="0" cellpadding="0" align="center" border="0">
<tr>
<td style="PADDING-BOTTOM: 0px; PADDING-TOP: 16px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px" align="center">
<table cellspacing="0" cellpadding="0" border="0">
<tr>
<td style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; BACKGROUND-COLOR: transparent"><img style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; BORDER-BOTTOM: medium none; BORDER-LEFT: medium none; DISPLAY: block" alt="" src="{{config('app.url')}}/images/mail-invite/Image_5_a21fc2c3-dacc-4eca-bf54-f5c8701677d7.png" width="788" hspace="0" vspace="0" /></td>
</tr>
</table>
</td>
</tr>
</table>
<!--[if gte mso 12]>
    </td></tr></table>
<![endif]-->
<p style="FONT-SIZE: 24px; MARGIN-BOTTOM: 1em; FONT-FAMILY: arial, helvetica, sans-serif; MARGIN-TOP: 0px; COLOR: #feffff; TEXT-ALIGN: center; LINE-HEIGHT: 37px; BACKGROUND-COLOR: transparent; mso-line-height-rule: exactly" align="center">Camelot SRL<br />
Sede Operativa: Strada di Collescipoli, 57 05100 Terni (TR)<br />
PIVA: 03882090545 - info@camelot-italia.it<br />
<a title="" style="TEXT-DECORATION: none; COLOR: #c28607" href="https://www.privacylab.it/informativa.php?21504470116"><span style="COLOR: #feffff">Privacy</span></a></p>
</th>
</tr>
</table>
</th>
</tr>
<tr>
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 792px; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 1px; TEXT-ALIGN: left; PADDING-TOP: 1px; PADDING-LEFT: 0px; BORDER-LEFT: medium none; PADDING-RIGHT: 0px; BACKGROUND-COLOR: transparent">
<table style="WIDTH: 100%" cellspacing="0" cellpadding="0" align="left">
<tr style="HEIGHT: 10px" height="10">
<th class="contenttd" style="BORDER-TOP: medium none; BORDER-RIGHT: medium none; WIDTH: 762px; VERTICAL-ALIGN: top; BORDER-BOTTOM: medium none; FONT-WEIGHT: normal; PADDING-BOTTOM: 1px; TEXT-ALIGN: left; PADDING-TOP: 1px; PADDING-LEFT: 15px; BORDER-LEFT: medium none; PADDING-RIGHT: 15px; BACKGROUND-COLOR: #feffff"></th>
</tr>
</table>
</th>
</tr>
</table>
</td>
</tr>
<tr>
<td style="FONT-SIZE: 0px; HEIGHT: 8px; LINE-HEIGHT: 0">&nbsp;</td>
</tr>
</table>
<!-- Created with MailStyler 2.3.1.100 -->
</body>
</html>
