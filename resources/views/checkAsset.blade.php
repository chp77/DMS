<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Warranty Status Inquiry</title>
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
    }

    body {
      font-family: Arial, sans-serif;
    }

    .header-container {
      background-color: #333;
      height: 80px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0 20px;
    }

    .header-logo {
      height: 50px;
    }

    .header-logo img {
      height: 100%;
    }

    .header-menu {
      display: flex;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .header-menu li {
      margin-right: 20px;
    }

    .header-menu a {
      color: #fff;
      text-decoration: none;
    }

    .main-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 50px 0;
      flex: 1;
    }

    .warranty-status-form {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 30px;
    }

    .warranty-status-form h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .warranty-status-form input[type="text"] {
      width: 300px;
      height: 40px;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 0 10px;
      font-size: 16px;
      margin-bottom: 20px;
    }

    .warranty-status-form button {
      width: 300px;
      height: 40px;
      background-color: #006ce1;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    .warranty-status-form button:hover {
      background-color: #006ce1;
      opacity: 0.6;
    }

    .warranty-status-form button:disabled {
      background-color: grey;
      cursor: not-allowed;
    }

    .footer-container {
      background-color: #eee;
      padding: 20px;
      text-align: center;
    }

    .footer-container a {
      color: #333;
      text-decoration: none;
      margin-right: 10px;
    }

    .breadcrumb {
      background-color: #f2f2f2;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
    }

    .breadcrumb ol {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
    }

    .breadcrumb li {
      margin-right: 10px;
    }

    .breadcrumb a {
      color: #333;
      text-decoration: none;
    }

    .breadcrumb li:last-child {
      font-weight: bold;
      color: #666;
    }

    .breadcrumb li[aria-current="page"] {
      color: #f04;
    }

    .contactSection.topBorder {
      border-top: 2px solid rgba(60,60,60,.26);
      margin-top: 20px;
    }

    .contactSection {
      width: 70%;
      padding: 40px 0 20px;
      line-height: normal;
    }

    .contactSection .SectionTitle {
      margin-bottom: 20px;
      font-size: 42px;
      font-weight: 600;
      color: #181818;
    }

    .contactSection .contactSectionDesc {
      font-size: 17px;
      line-height: normal;
      color: #666;
      margin-bottom: 20px;
    }

    .contactSection .contact-section-button {
      max-width: 240px;
      box-sizing: border-box;
    }

    .default-button-wrapper {
      border: 0;
      border-radius: 4px;
      padding: 16px;
      text-align: center;
      width: 100%;
      display: inline-block;
      font-size: 17px;
      line-height: 1;
      outline: none;
    }

    .default-button-wrapper.button-default {
      -webkit-transition: color,background .4s ease-in-out;
      -moz-transition: color,background .4s ease-in-out;
      -o-transition: color,background .4s ease-in-out;
      transition: color,background .4s ease-in-out;
      background: #006ce1;
      color: #fff;
      cursor: pointer;
    }

    h2 {
      font-size: 46px;
      font-weight: 500;
      margin-bottom: 30px;
      line-height: 36px;
      min-width: 240px;
    }

    @media (max-width: 600px) {
      h2 {
        font-size: 24px;
        margin-bottom: 20px;
        line-height: 28px;
      }

      .warranty-status-form input[type="text"], .warranty-status-form button {
        width: 80%;
      }

      .contactSection {
        width: 90%;
      }
    }
  </style>
</head>
<body>
  <nav aria-label="Breadcrumb" class="breadcrumb">
    <ol>
      <li>AMS ></li>
      <li>Support ></li>
      <li aria-current="page">Warranty-Status-Inquiry</li>
    </ol>
  </nav>

  <main class="main-container">
    <form method="POST" action="{{ route('deviceInfo') }}">
    @csrf
      <div class="warranty-status-form">
          <h2>Check your Warranty Status</h2>
          <input style="box-sizing: border-box; width: 55%; height: 48px; padding: 11px 16px; font-family: 微軟正黑體,新細明體,Arial Unicode MS,Arial,Helvetica,sans-serif; font-size: 18px; color: #666;" type="text" name="serial_number" placeholder="Enter your serial number">
          
          <div class="row" style="width: 55%; margin-bottom: 20px;">
            <input id="checkPrivacy" type="checkbox" name="check-privacy" tabindex="0" aria-label="agree to privacy">
            <span style="line-height: 20px; font-size: 13px; color: #333333;">I agree to provide my product serial no. to AMS to inquire the warranty period of my product, and also agree to the “<a href="#">AMS Privacy Policy</a>”</span>
          </div>

          <button id="submitBtn" disabled>Submit</button>
          <hr style="border-bottom: 1px solid #ccc; border-top: 1px solid transparent; border-left: 1px solid transparent; border-right: 1px solid transparent; width: 450px; padding-bottom: 20px; margin: 35px auto 0;">
      </div>
    </form>

    <div class="contactSection topBorder">
      <div class="SectionTitle">Contact Support</div> 
      <div>
        <div class="contactSectionDesc">If you need more help, see our solutions to get support.</div>
        <button onclick="window.location.href='/contact'" aria-label="See support" type="button" class="default-button-wrapper contact-section-button button-default"><span>See support</span></button>
      </div>
    </div>
  </main>

  <footer class="footer-container">
    <strong>Copyright © 2024 EP-Asia. All rights reserved.</strong>
  </footer>

  <script>
    document.getElementById('checkPrivacy').addEventListener('change', function() {
      document.getElementById('submitBtn').disabled = !this.checked;
    });
  </script>
</body>
</html>
