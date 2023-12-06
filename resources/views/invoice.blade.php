<<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Invoice</title>
    </head>
    <style type="text/css" media="all">
        @import url("https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;1,400;1,500;1,700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Red+Hat+Display:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Flex:opsz,wght@8..144,400;8..144,500;8..144,600;8..144,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto", sans-serif;
        }

        h1,
        h2,
        h3,
        p {
            margin: 0;
            padding: 0;
        }


        .invoice-container {
            display: flex;
            flex-direction: column;
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }


        .invoice_sec {
            margin-bottom: 20px;
        }

        .invoice {
            font-size: 24px;
        }

        .invoice_no {
            margin-top: 5px;
        }

        .date {
            margin-top: 5px;
        }


        .bill_total_wrap {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .bill_sec {
            flex: 2;
        }

        .name {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .total_wrap {
            flex: 1;
            text-align: right;
        }

        .price {
            font-size: 24px;
        }


        .items {

            padding-top: 20px;
        }

        .header-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .header-col {
            flex: 1;
        }


        .item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }

        .col_des {
            flex: 2;
        }

        .grandtotal_sec {
            text-align: right;
            margin-top: 20px;
        }
    </style>
    </head>

    </head>

    <body>
        <div class="invoice-container">
            <div class="invoice_sec">
                <p class="invoice bold">INVOICE</p>
                <p class="invoice_no">
                    <span class="bold">Invoice</span>
                    <span>#{{ $subscription->id }}</span>
                </p>
                <p class="date">
                    <span class="bold">Date</span>
                    <span>{{ $subscription->created_at }}</span>
                </p>
            </div>
            <div class="bill_total_wrap">
                <div class="bill_sec">
                    <p>Bill To</p>
                    <p class="bold name">{{ $subscription->user->name }}</p>
                    <span>{{ $subscription->address }}</span>
                </div>
                <div class="total_wrap">
                    <p>Total Due</p>
                    <p class="bold price">{{ $price }}</p>
                </div>
            </div>
        </div>
        <div class="body">
            <div class="items">

                <div class="header-row">
                    <div class="header-col">
                        <p class="item-description">Description</p>
                    </div>
                </div>

                <div class="item">
                    <div class="col_des">
                        <p class="item-description">
                            {{ $subscription->subscriptionPlan->name }} Subscription
                        </p>
                    </div>
                </div>
                <div class="paymethod_grandtotal_wrap">
                    <div class="grandtotal_sec">
                        <p class="bold">
                            <span>Sub total</span>
                            <span>{{ $price_without_tax }}</span>
                        </p>
                        <p>
                            <span>Tax 18%</span>
                            <span>{{ $tax }}</span>
                        </p>
                        <p class="bold">
                            <span>Grand Total</span>
                            <span>{{ $price }}</span>
                        </p>
                    </div>
                </div>
            </div>
    </body>

    </html>