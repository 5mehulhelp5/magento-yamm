# Mageserv_Yamm – Instant Refund Integration via Yamm.sa

**Mageserv_Yamm** is a Magento 2 extension that integrates with [Yamm.sa](https://yamm.sa/), a Saudi-based solution that provides instant, automated refunds and returns for eCommerce merchants.

This module enables store admins to trigger customer refunds directly from the Magento backend using Yamm’s API — with no need for manual bank transfers or third-party payment gateways.

---

## 🌟 Why Yamm?

**Yamm.sa** offers a full-stack returns solution that:
- Instantly refunds customers to their preferred method 
- Improves customer satisfaction with faster resolution
- Reduces operational load from manual refund handling
- Ensures compliance and traceability with local regulations

> This extension does **not** act as a payment method. It complements your existing payment setup by automating post-sale refund processing.

---

## 🧰 Requirements

- Magento 2.4.x or higher
- PHP 8.x
- Valid Yamm.sa merchant account
- API credentials from Yamm

---

## 📦 Installation

### Manual Installation

1. Place the module into your Magento codebase:

```bash
mkdir -p app/code/Mageserv/Yamm
git clone https://github.com/your-org/magento-yamm-refund.git app/code/Mageserv/Yamm
