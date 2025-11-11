<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS view asset details</title>

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
      flex-direction: column;
      align-items: center;
      padding: 50px 0;
      width: 100%;
      flex: 1;
    }

    .warranty-status-form {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 30px;
      margin-left: 50px;
      margin-right: 50px;
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

      .active, .accordion1:hover {
        background-color: #ccc !important; 
      }
    }
  </style>
  </head>
<body>
  <nav aria-label="Breadcrumb" class="breadcrumb">
    <ol>
      <li>AMS ></li>
      <li aria-current="page">View asset details</li>
    </ol>
  </nav>

  <main class="main-container">
    <div class="warranty-status-form">
      <h2>Asset Details</h2>
      <!-- <h4 style="color: #4d4d4d; top: -20px;"></h4> -->
      <div class="contactSupportServiceWrapper" style="width: 100%">
        <div class="contactSupportServiceBlock" style="padding: 30px; border: 1px solid grey;">
        <div style="display: flex;">
          <div style="width: 50%">
            <div class="form-group" style="padding-bottom: 5px;">
              <label>Order no.: </label>
              <strong>{{ $asset->order_number }}</strong>
            </div>
            <div class="form-group" style="padding-bottom: 5px;">
              <label>Customer order no.: </label>
              <strong>{{ $asset->customer_order_number }}</strong>
            </div>
            <div class="form-group" style="padding-bottom: 5px;">
              <label>Model: </label>
              <strong>{{ $asset->model_name }}</strong>
            </div>
            <div class="form-group" style="padding-bottom: 5px;">
              <label>Brand: </label>
              <strong>{{ $asset->brand_name }}</strong>
            </div>
            <div class="form-group" style="padding-bottom: 5px;">
              <label>SKU code: </label>
              <strong>{{ $asset->sku }}</strong>
            </div>
            <div class="form-group" style="padding-bottom: 5px;">
              <label>Serial no.: </label>
              <strong>{{ $asset->serial_number }}</strong>
            </div>

            <div class="form-group" style="padding-bottom: 5px;">
              <label>MAC address: </label>
              <strong>{{ $asset->mac_address }}</strong>
            </div>
            <div class="form-group" style="padding-bottom: 5px;">
              <label>Manufacture date: </label>
              <strong>{{ $asset->manufacture_date }}</strong>
            </div>
            <div class="form-group" style="padding-bottom: 5px;">
              <label>Warranty period: </label>
              <strong>{{ $asset->warranty_period }} Years</strong>
            </div>
            <div class="form-group" style="padding-bottom: 5px;">
              <label>Warranty start date: </label>
              <strong>{{ $asset->warranty_started_date }}</strong>
            </div>
            <div class="form-group" style="padding-bottom: 5px;">
              <label>Warranty expiry date: </label>
              <strong>{{ $asset->warranty_expiry_date }}</strong>
            </div>
            <div class="form-group" style="padding-bottom: 5px;">
              <label>QA video link: </label>
              @if(empty($asset->qa_video_url))
                <strong>{{ $asset->qa_video_url }}</strong>
              @else
                <strong><a href="{{ $asset->qa_video_url }}" target="_blank">{{ $asset->qa_video_url }}</a></strong>
              @endif
            </div>
            <div class="form-group" style="padding-bottom: 5px;">
              <label">Remarks: </label>
              <strong>{{ $asset->remarks }}</strong>
            </div>
          </div>

            @if (!empty($asset->component_details))
            <div style="width: 50%">
              <div class="form-group" style="padding-bottom: 5px;">
                <label>Components: </label>
              </div>
                @foreach($asset->component_details as $item)
                  <div class="form-group" style="margin-top: 15px; background-color: #eee; color: #444; cursor: pointer; border: none; text-align: left; outline: none; font-size: 15px; transition: 0.4s;">
                    <label class="accordion1" style="cursor: pointer; display: block; width: 100%; padding: 18px;">{{$item['category']}}</label>
                    <div class="panel1" style="padding: 0 18px; display: none; background-color: white; overflow: hidden;">
                    <div style="display: flex;">
                      <div style="width: 50%;">
                        <div class="form-group" style="margin-top: 10px; padding-bottom: 5px;">
                            <label>Brand: </label>
                            <strong>{{ $item['brand_name'] }}</strong>
                        </div>
                        <div class="form-group" style="padding-bottom: 5px;">
                            <label>Model: </label>
                            <strong>{{ $item['model_name'] }}</strong>
                        </div>
                        <div class="form-group" style="padding-bottom: 5px;">
                            <label>Price: </label>
                            <strong>{{ $item['currency'] }} {{ $item['price'] }}</strong>
                        </div>
                        @if (!empty($item['specification']))
                          @php
                            $item['specification'] = json_decode($item['specification'], true);
                          @endphp
                          @if ($item['category'] == 'Android Motherboard')
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Sytem Version: </label>
                              <strong>{{ $item['specification'][0]['system version'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>CPU: </label>
                              <strong>{{ $item['specification'][0]['cpu'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>GPU: </label>
                              <strong>{{ $item['specification'][0]['gpu'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>RAM: </label>
                              <strong>{{ $item['specification'][0]['ram'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Storage: </label>
                              <strong>{{ $item['specification'][0]['storage'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Wifi: </label>
                              <strong>{{ $item['specification'][0]['wifi'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Hotspot: </label>
                              <strong>{{ $item['specification'][0]['hotspot'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Bluetooth: </label>
                              <strong>{{ $item['specification'][0]['bluetooth'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>WAN: </label>
                              <strong>{{ $item['specification'][0]['wan'] }}</strong>
                            </div>
                          @endif

                          @if ($item['category'] == 'Front Board')
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>USB: </label>
                              <strong>{{ $item['specification'][0]['usb'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Type-C: </label>
                              <strong>{{ $item['specification'][0]['type-c'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>HDMI: </label>
                              <strong>{{ $item['specification'][0]['hdmi'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Touch: </label>
                              <strong>{{ $item['specification'][0]['touch'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Light Sensitivity: </label>
                              <strong>{{ $item['specification'][0]['light sensitivity'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>IR: </label>
                              <strong>{{ $item['specification'][0]['ir'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>LED: </label>
                              <strong>{{ $item['specification'][0]['led'] }}</strong>
                            </div>
                          @endif
                          
                          @if ($item['category'] == 'Tempered Glass')
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Size: </label>
                              <strong>{{ $item['specification'][0]['size'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Thickness: </label>
                              <strong>{{ $item['specification'][0]['thickness'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>AG: </label>
                              <strong>{{ $item['specification'][0]['ag'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Silk Screen Color: </label>
                              <strong>{{ $item['specification'][0]['color'] }}</strong>
                            </div>
                          @endif

                          @if ($item['category'] == 'Touch')
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Size: </label>
                              <strong>{{ $item['specification'][0]['size'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Touch Mode: </label>
                              <strong>{{ $item['specification'][0]['mode'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Touch Point: </label>
                              <strong>{{ $item['specification'][0]['point'] }}</strong>
                            </div>
                          @endif

                          @if ($item['category'] == 'Power Board')
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Size: </label>
                              <strong>{{ $item['specification'][0]['size'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Total Power: </label>
                              <strong>{{ $item['specification'][0]['total power'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>LED Power: </label>
                              <strong>{{ $item['specification'][0]['led power'] }}</strong>
                            </div>
                          @endif

                          @if ($item['category'] == 'OC')
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Size: </label>
                              <strong>{{ $item['specification'][0]['size'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Level: </label>
                              <strong>{{ $item['specification'][0]['level'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Resolution: </label>
                              <strong>{{ $item['specification'][0]['resolution'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Contrast: </label>
                              <strong>{{ $item['specification'][0]['contrast'] }}</strong>
                            </div>
                          @endif

                          @if ($item['category'] == 'Materials')
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Size: </label>
                              <strong>{{ $item['specification'][0]['size'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Fitting Method: </label>
                              <strong>{{ $item['specification'][0]['fitting method'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Color: </label>
                              <strong>{{ $item['specification'][0]['color'] }}</strong>
                            </div>
                          @endif

                          @if ($item['category'] == 'Logic Board')
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Size: </label>
                              <strong>{{ $item['specification'][0]['size'] }}</strong>
                            </div>
                          @endif

                          @if ($item['category'] == 'LED Light Strip')
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Size: </label>
                              <strong>{{ $item['specification'][0]['size'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Lamp Power: </label>
                              <strong>{{ $item['specification'][0]['lamp power'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Number of Lamp Beads: </label>
                              <strong>{{ $item['specification'][0]['number of lamp beads'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Number of Light Bars: </label>
                              <strong>{{ $item['specification'][0]['number of light bars'] }}</strong>
                            </div>
                            <div class="form-group" style="padding-bottom: 5px;">
                              <label>Adaptable Backplane: </label>
                              <strong>{{ $item['specification'][0]['adaptable backplane'] }}</strong>
                            </div>
                          @endif
                        @endif
                        <div class="form-group" style="padding-bottom: 5px;">
                            <label>Remarks: </label>
                            <strong>{{ $item['remarks'] }}</strong>
                        </div>
                      </div>

                      <div style="width: 50%; float: right;">
                        <div class="form-group" style="margin-top: 10px;">
                            @if (!empty($item['product_image']))
                              @php
                                $imageSrc = str_replace(['[', ']'], '', $item['product_image']);
                              @endphp

                              @if (!empty($imageSrc))
                                <a href="{{ $imageSrc }}" target="_blank"><img width="200" height="200" src="{{ $imageSrc }}" alt="Image preview" class="row img-thumbnail" /></a>
                              @endif
                            @endif
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                @endforeach
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="footer-container">
    <strong>Copyright © 2024 EP-Asia. All rights reserved.</strong>
  </footer>

  <script>
    var acc = document.getElementsByClassName("accordion1");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
          panel.style.display = "none";
        } else {
          panel.style.display = "block";
        }
      });
    }
  </script>
</body>
</html>