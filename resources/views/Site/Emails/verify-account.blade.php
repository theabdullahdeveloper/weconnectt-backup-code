<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
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
                <h1 style="text-align: center; margin: 0; padding-bottom: 25px; text-transform: uppercase;">Your Email Not Verified</h1>
                <h2 style="text-align: center; margin: 0; padding-bottom: 25px; font-size: 22px;">Verify Your Email Address</h2> 
                <p style="margin: 0 40px; padding-bottom: 25px; line-height: 2; font-size: 15px; text-align: center;">First, copy the OTP provided in the email.Click on the "Verify" button below.Once redirected, paste the copied OTP into the provided field.Proceed with the email verification process after entering the OTP.</p>
                <center><h2  class="expiry">OTP: {{ $otp }}</h2> </center>
              </td>
            </tr>
            <tr class="button-container">
              <td style="text-align: center;">
                <a href="{{route ('user.email.verified', $token )}}" target="_blank" style="background-color: #36b445; color: white; padding: 15px 97px; outline: none; display: block; margin: 25px auto; border-radius: 31px; font-weight: bold; border: none; text-transform: uppercase; cursor: pointer; text-decoration: none; width:10%; align-items: center;">Verify</a>
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
