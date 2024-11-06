<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professional Details</title>
  <style>
    @media only screen and (max-width: 480px) {
      .content p {
        margin: 0 20px;
      }

      .button-container a {
        padding: 15px 40px;
      }
    }
  </style>
</head>

<body style="background-color: #0f3462; margin: 0; padding: 50px;">
  
    <!-- Main table -->
    <table class="main-table" border="0" align="center" cellspacing="0" cellpadding="0" style="width: 100%; max-width: 650px; margin: auto; background-color: white;">
      <tr>
        <td>
          <!-- Child table --><br><br><br>
          <table class="content-table" border="0" cellspacing="0" cellpadding="0" style="color: #0f3462; font-family: sans-serif; padding: 0 20px;">
            <tr class="header">
              <td style="text-align: center;">
                <img src="/{{ asset($theme->logo) }}" alt="Weconnect-Logo" style="width: 300px;">
                <br><br>
              </td>
            </tr>
            <tr class="content">
              <td>
                <!-- <h1 style="text-align: center; margin: 0; padding-bottom: 25px; text-transform: uppercase;">Forgot your password?</h1> -->
                <h2 style="text-align: center; margin: 0; padding-bottom: 25px; font-size: 22px;">Request Response</h2>
                <p style="margin: 0 40px; padding-bottom: 25px; line-height: 2; font-size: 15px; text-align: center;">In response to your request, the user <b>{{ $logined_user_name }}</b> has paid credits to obtain your contact details from us. The contact information provided by the user includes <b>{{ $logined_user_email  }}</b> and <b>{{ $logined_user_phone_number }}</b>. It is likely that this user will contact you soon. You can provide them with all the necessary details related to your request and delegate the task to them. Additionally, you can view their public profile below, where you will find reviews related to their previous work. This will help you assess their capabilities and ensure they are a good fit for your requirements. Thank you for using our services.</p>
                <!--  <h2 class="expiry">Expires: 05 November</h2> -->
              </td>
            </tr>
            <tr class="button-container">
              <td style="text-align: center;">
                <a href="{{ url('/professional/public/profile/'. $logined_user_email) }}" target="_blank" style="background-color: #36b445; color: white; padding: 15px 97px; outline: none; display: block; margin: 25px auto; border-radius: 31px; font-weight: bold; border: none; text-transform: uppercase; cursor: pointer; text-decoration: none; width: 30%; align-items: center;">View {{ $logined_user_name }} Profile</a>
              </td>
            </tr>
            <tr class="footer">
              <td style="text-align: center;">
                <footer class="footer">
                  <p class="footer-text" style="padding-top: 25px; line-height: 1; margin: 0;">© <script>document.write(new Date().getFullYear())</script> Weconnectt. All Rights Reserved.</p>
                </footer>
              </td>
            </tr>
            <br><br><br>
          </table>
          <!-- /Child table -->
        </td>
      </tr>
    </table>
    <!-- / Main table -->
  
</body>

</html>
