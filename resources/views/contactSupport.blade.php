<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Support</title>

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

      .contactSupportWrapper .contactSupportServiceWrapper {
        position: relative;
        width: 100%;
        max-width: 1236px;
        min-height: 290px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: stretch;
      }

      .contactSupportWrapper .contactSupportServiceWrapper .contactSupportServiceBlock {
        width: 404px;
        border: 1px solid #b3b3b3;
        padding: 16px 24px 24px;
        margin-right: 12px;
        text-align: center;
      }
    }
  </style>
  </head>
<body>
  <nav aria-label="Breadcrumb" class="breadcrumb">
    <ol>
      <li>AMS ></li>
      <li>Support ></li>
      <li aria-current="page">Contact-Support</li>
    </ol>
  </nav>

  <main class="main-container">
      <div class="warranty-status-form">
          <h2>Contact Support</h2>
          <h4 style="color: #4d4d4d; top: -20px;">Choose a contact method that is most convenient for you.</h4>
          <div class="contactSupportServiceWrapper" style="text-align: center;">
            <div class="contactSupportServiceBlock" style="padding: 20px; border: 1px solid grey;">
                <div class="contactSupportServiceImage">
                    <span data-v-7e38bc32="" class="svg-image">
                        <svg xmlns="https://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 122 122" v-bind:svg-inline="''" v-bind:src="'@svg/icon-mail.svg'" v-bind:role="'presentation'" v-bind:focusable="'false'"><path fill="#000" d="M83.58 20.225v44.79L67 78.326l-6.017-4.828a1.566 1.566 0 00-1.968 0l-6.014 4.825-16.582-13.31V20.226h47.16zM69.557 80.38l23.27-18.678v37.36L69.557 80.38zM60 76.814l29.845 23.96H30.154l29.845-23.96zM27.173 61.698l23.27 18.678-23.27 18.684V61.698zm68.787 40.886c.009-.066.04-.126.04-.192V58.37c0-.032-.017-.058-.017-.087a2.447 2.447 0 00-.025-.201 1.995 1.995 0 00-.13-.412c-.029-.06-.066-.109-.1-.166-.028-.044-.034-.093-.065-.133-.022-.029-.054-.04-.076-.063a1.057 1.057 0 00-.139-.138c-.02-.02-.028-.046-.05-.064l-8.645-6.933V18.61A1.6 1.6 0 0085.165 17H34.832c-.874 0-1.582.722-1.582 1.611v31.547l-8.647 6.948c-.02.018-.031.044-.048.06a.966.966 0 00-.15.156c-.02.018-.046.026-.063.05-.028.037-.033.08-.059.12-.037.06-.08.112-.11.176-.029.06-.048.123-.071.187a1.906 1.906 0 00-.082.422c-.003.03-.02.058-.02.093v44.022c0 .066.028.126.04.192.01.113.028.22.065.328.034.107.09.199.144.294.037.057.048.127.09.181.023.026.052.038.071.063.074.081.159.147.25.21.079.06.152.127.243.17.082.04.173.058.263.084.113.034.218.063.334.069.031 0 .054.017.085.017h68.827c.232 0 .45-.055.648-.15.057-.023.1-.069.153-.103.142-.084.272-.181.38-.305.02-.023.048-.032.065-.055.045-.054.056-.124.093-.181.054-.095.107-.187.144-.294.037-.109.051-.215.065-.328z" fill-rule="evenodd"></path></svg>
                    </span>
                    <div class="contactSupportServiceImageLabel">Mail</div>
                </div>
                <div class="contactSupportServiceDesc">
                    Send E-mail to AMS Customer Service mailbox. We will reply your inquiry as soon as possible.
                </div> 
                <button style="margin-top: 15px;" aria-label="GET STARTED" type="button" class="default-button-wrapper service-btn button-default">
                    <span>GET STARTED</span>
                </button>
            </div>

            <div class="contactSupportServiceBlock" style="margin-top: 20px; padding: 20px; border: 1px solid grey;">
                <div class="contactSupportServiceImage">
                    <span data-v-7e38bc32="" class="svg-image">
                        <svg xmlns="https://www.w3.org/2000/svg" width="122" height="122" viewBox="0 0 122 122" v-bind:svg-inline="''" v-bind:src="'@svg/icon-call.svg'" v-bind:role="'presentation'" v-bind:focusable="'false'"><g fill-rule="evenodd"><path d="M80.685 105.533h-39.37c-.979 0-1.772-.779-1.772-1.733V88.87h42.914v14.93c0 .954-.793 1.733-1.772 1.733zm-39.37-88.066h39.37c.979 0 1.772.776 1.772 1.733v6.709H39.543V19.2c0-.957.793-1.733 1.772-1.733zm-1.772 67.937h42.914V29.376H39.543v56.028zM80.685 14h-39.37C38.382 14 36 16.33 36 19.2v84.6c0 2.87 2.382 5.2 5.315 5.2h39.37c2.93 0 5.315-2.33 5.315-5.2V19.2c0-2.87-2.385-5.2-5.315-5.2z"></path><path d="M61.002 99.46a2.463 2.463 0 01-2.46-2.46c0-1.355 1.1-2.46 2.46-2.46A2.46 2.46 0 0163.458 97c0 1.352-1.1 2.46-2.456 2.46m0-8.46A6.006 6.006 0 0055 97c0 3.308 2.69 6 6.002 6A6.007 6.007 0 0067 97c0-3.308-2.693-6-5.998-6m-2.225-68h4.446c.979 0 1.777-.895 1.777-1.996C65 19.895 64.202 19 63.223 19h-4.446c-.982 0-1.777.895-1.777 2.004 0 1.1.795 1.996 1.777 1.996"></path></g></svg>
                    </span>
                    <div class="contactSupportServiceImageLabel">Call</div>
                </div>
                <div class="contactSupportServiceDesc">
                    Talk to the Service agent over phone service for instant support.
                </div> 
                <button style="margin-top: 15px;" aria-label="GET STARTED" type="button" class="default-button-wrapper service-btn button-default">
                    <span>GET STARTED</span> 
                </button>
            </div>
</div>
      </div>
  </main>

  <footer class="footer-container">
    <strong>Copyright © 2024 EP-Asia. All rights reserved.</strong>
  </footer>
</body>
</html>