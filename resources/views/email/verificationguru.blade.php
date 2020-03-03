@extends('email.template')


@section('title',"Verifikasi Email")

@section('content')
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Halo!</p>
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;">Silakan verifikasi akun yang kamu daftarkan dengan cara klik tombol di bawah ini!</p>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%;" width="100%">
        <tbody>
        <tr>
            <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;" valign="top">
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto; margin: auto;">
                    <tbody>
                    <tr>
                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; border-radius: 5px; text-align: center; background-color: #3498db;" valign="top" align="center" bgcolor="#3498db"> 
                            <a href="{{ $link }}" target="_blank" style="border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; background-color: #3498db; border-color: #3498db; color: #ffffff;">Verifikasi Email</a> </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
    <br/>
    <div style="margin: auto; width: 100%; text-align: center; align: center;">
        <a style="font-family: sans-serif; font-size: 18pt; font-weight: normal; margin: auto; margin-top: 12px; margin-bottom: 0px;" href="https://chat.whatsapp.com/B8DvWxIujUeFQYs1f9bZ0k">Gabung dengan Group WhatsApp Guru SapaGuru</a>
        <br/>
        {{-- <img src="https://sapaguru.com/img/barcode_group_line_guru.jpeg"> --}}
    </div>
    <br/>
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-top: 12px; margin-bottom: 0px;">Abaikan email ini apabila kamu merasa tidak mendaftarkan akun ini</p>
@endsection