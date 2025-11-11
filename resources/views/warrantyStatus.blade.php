<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Warranty Status</title>

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
      <li aria-current="page">Warranty-Status</li>
    </ol>
  </nav>

  <main class="main-container">
      <div class="warranty-status-form">
          <h2>Your Warranty Status</h2>
          <hr style="border-bottom: 1px solid #ccc; border-top: 1px solid transparent; border-left: 1px solid transparent; border-right: 1px solid transparent; width: 450px; padding-bottom: 0px; margin: 0px auto 20px;">
          @if(empty($asset))
            <h3 style="color: red;">No data found!</h3>
            <button onclick="window.location.href='/check'">Back</button>
          @else
            <label style="padding: 10px;"><strong>Brand:</strong> {{ $asset->brand }}</label>
            <label style="padding: 10px;"><strong>Model:</strong> {{ $asset->model }}</label>
            @if($asset->ram !== '')
              <label style="padding: 10px;"><strong>RAM:</strong> {{ $asset->ram }} GB</label>
            @endif
            @if($asset->storage !== '')
              <label style="padding: 10px;"><strong>Storage:</strong> {{ $asset->storage }} GB</label>
            @endif
            @if($asset->wifi !== '')
              <label style="padding: 10px;"><strong>Wifi:</strong> {{ $asset->wifi }}</label>
            @endif
            <label style="padding: 10px;"><strong>Serial number:</strong> {{ $asset->serial_number }}</label>
            <label style="padding: 10px;"><strong>MAC address:</strong> {{ $asset->mac_address }}</label>
            <label style="padding: 10px;"><strong>Warranty Period:</strong> {{ $asset->warranty_period }} Years</label>
            <label style="padding: 10px; margin-bottom: 10px;"><strong>Warranty Expiry Date:</strong> {{ $asset->warranty_expiry_date }}</label>
            <button onclick="window.location.href='/check'">Back</button>
          @endif
      </div>
  </main>

  <footer class="footer-container">
    <strong>Copyright © 2024 EP-Asia. All rights reserved.</strong>
  </footer>
</body>
</html>