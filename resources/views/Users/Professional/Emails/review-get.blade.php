<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">
  <link href="{{ asset('Admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
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
                <h2 style="text-align: center; margin: 0; padding-bottom: 25px; text-transform: uppercase;">New Review Received   </h2>
                <h2 style="text-align: center; margin: 0; padding-bottom: 25px; font-size: 22px;">You have received a new review from <strong>{{ $feedbacker_name }}</h2> 
               
                <!--  <h2 class="expiry">Expires: 05 November</h2> -->
              </td>
            </tr>
            <tr>
        <td>
        <center>
        
        <table class="info-table" style="width: 85%; border-collapse: collapse; margin: 0 auto;">
                  
        <tbody>
    <tr style="background-color: #f2f2f2;">
        <td style="border: 1px solid #0f3462; padding: 12px;">Email</td>
        <td style="border: 1px solid #0f3462; padding: 12px; text-align: center;">{{ $feedbacker_email }}</td>
    </tr>
    <tr>
        <td style="border: 1px solid #0f3462; padding: 12px;">Feedback</td>
        <td style="border: 1px solid #0f3462; padding: 12px; text-align: center;">{{ $feedback }}</td>
    </tr>
    <tr style="background-color: #f2f2f2;">
        <td style="border: 1px solid #0f3462; padding: 12px;">Rating</td>
        <td style="border: 1px solid #0f3462; padding: 12px; text-align: center;">
           {{ $rating }} / 5
        </td>
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
