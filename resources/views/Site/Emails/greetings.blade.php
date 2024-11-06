<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome {{ $name }}</title>
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
                <h2 style="text-align: center; margin: 0; padding-bottom: 25px; text-transform: uppercase;">Welcome, {{$name}}</h2>
                <!-- <h2 style="text-align: center; margin: 0; padding-bottom: 25px; font-size: 22px;">Reset your password now</h2> -->
                <p style="margin: 0 40px; padding-bottom: 25px; line-height: 2; font-size: 15px; text-align: center;">On behalf of the Weconnectt team, we extend our heartfelt greetings to you. We are thrilled to welcome you to our community and are eager to embark on this journey together. Your presence is highly valued and appreciated as we strive to create meaningful experiences and provide exceptional services. Rest assured, we are committed to supporting you every step of the way and ensuring your satisfaction. If you have any questions or need assistance, please feel free to reach out to us. Thank you for choosing Weconnectt. We look forward to a fruitful association with you.</p>
                <!--  <h2 class="expiry">Expires: 05 November</h2> -->
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
