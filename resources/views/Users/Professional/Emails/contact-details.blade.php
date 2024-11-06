<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contect Details</title>
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
                <h2 style="text-align: center; margin: 0; padding-bottom: 25px; text-transform: uppercase;">contact details</h2>
                <h2 style="text-align: center; margin: 0; padding-bottom: 25px; font-size: 22px;">Here Are the Requested Details</h2> 
                <p style="margin: 0 40px; padding-bottom: 25px; line-height: 2; font-size: 15px; text-align: center;">Your purchased details have been dispatched! Also stored in Payment Details on Your Dashboard..</p>
                <!--  <h2 class="expiry">Expires: 05 November</h2> -->
              </td>
            </tr>
            <tr>
        <td>
        <center>
        
        <table class="info-table" style="width: 85%; border-collapse: collapse; margin: 0 auto;">
                  
                  <tbody>
                    <tr style="background-color: #f2f2f2;">
                      <td style="border: 1px solid #0f3462; padding: 12px; ">Name</td>
                      <td style="border: 1px solid #0f3462; padding: 12px; text-align: center;">{{ $name }}</td>
                    </tr>
                    <tr>
                      <td style="border: 1px solid #0f3462; padding: 12px;">Email</td>
                      <td style="border: 1px solid #0f3462; padding: 12px; text-align: center;">{{ $email }}</td>
                    </tr>
                    <tr style="background-color: #f2f2f2;">
                      <td style="border: 1px solid #0f3462; padding: 12px; ">Phone Number</td>
                      <td style="border: 1px solid #0f3462; padding: 12px; text-align: center;">{{ $phone_number }}</td>
                    </tr>
                    <tr>
                      <td style="border: 1px solid #0f3462; padding: 12px; ">Postcode</td>
                      <td style="border: 1px solid #0f3462; padding: 12px; text-align: center;">{{ $postcode }}</td>
                    </tr>
                    <tr style="background-color: #f2f2f2;">
                      <td style="border: 1px solid #0f3462; padding: 12px; ">Spending Credits</td>
                      <td style="border: 1px solid #0f3462; padding: 12px; text-align: center;">{{ $credits }}</td>
                    </tr>
                  </tbody>
                </table>
        
        </center>
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
