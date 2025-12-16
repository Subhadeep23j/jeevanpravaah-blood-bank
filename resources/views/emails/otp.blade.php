<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - JeevanPravaah</title>
</head>

<body
    style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4;">
    <table role="presentation" style="width: 100%; border-collapse: collapse;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation"
                    style="width: 600px; border-collapse: collapse; background-color: #ffffff; border-radius: 16px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <!-- Header -->
                    <tr>
                        <td
                            style="padding: 40px 40px 20px; text-align: center; background: linear-gradient(135deg, #dc2626 0%, #ec4899 100%); border-radius: 16px 16px 0 0;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: bold;">
                                ❤️ JeevanPravaah
                            </h1>
                            <p style="margin: 10px 0 0; color: rgba(255,255,255,0.9); font-size: 14px;">
                                Blood Donation Platform
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="margin: 0 0 20px; color: #1f2937; font-size: 24px;">
                                Hello, {{ $userName }}! 👋
                            </h2>
                            <p style="margin: 0 0 20px; color: #4b5563; font-size: 16px; line-height: 1.6;">
                                Thank you for registering with JeevanPravaah. To complete your registration, please use
                                the following One-Time Password (OTP):
                            </p>

                            <!-- OTP Box -->
                            <div style="text-align: center; margin: 30px 0;">
                                <div
                                    style="display: inline-block; background: linear-gradient(135deg, #fef2f2 0%, #fce7f3 100%); border: 2px dashed #dc2626; border-radius: 12px; padding: 20px 40px;">
                                    <p
                                        style="margin: 0 0 8px; color: #6b7280; font-size: 12px; text-transform: uppercase; letter-spacing: 2px;">
                                        Your OTP Code
                                    </p>
                                    <p
                                        style="margin: 0; color: #dc2626; font-size: 36px; font-weight: bold; letter-spacing: 8px;">
                                        {{ $otp }}
                                    </p>
                                </div>
                            </div>

                            <p style="margin: 0 0 10px; color: #4b5563; font-size: 14px; line-height: 1.6;">
                                ⏰ This OTP is valid for <strong>10 minutes</strong>.
                            </p>
                            <p style="margin: 0 0 20px; color: #4b5563; font-size: 14px; line-height: 1.6;">
                                🔒 If you didn't request this code, please ignore this email.
                            </p>

                            <!-- Divider -->
                            <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 30px 0;">

                            <p style="margin: 0; color: #9ca3af; font-size: 13px; line-height: 1.6;">
                                By verifying your email, you're one step closer to becoming a life-saver! 🩸
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td
                            style="padding: 20px 40px 30px; text-align: center; background-color: #f9fafb; border-radius: 0 0 16px 16px;">
                            <p style="margin: 0 0 10px; color: #6b7280; font-size: 13px;">
                                © {{ date('Y') }} JeevanPravaah. All rights reserved.
                            </p>
                            <p style="margin: 0; color: #9ca3af; font-size: 12px;">
                                This is an automated message, please do not reply.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
