# Postman Testing Summary - Mobile Admin Login

## Quick Start (3 Steps)

### 1️⃣ Open Postman and Create Login Request

```
POST http://localhost:8000/api/v1/admin/login

Headers:
  Content-Type: application/json

Body (Raw - JSON):
{
  "email": "admin@example.com",
  "password": "password123"
}
```

Click **Send** → Get token from response

---

### 2️⃣ Create Profile Request

```
GET http://localhost:8000/api/v1/admin/profile

Headers:
  Authorization: Bearer YOUR_TOKEN_HERE
  Content-Type: application/json
```

Click **Send** → Should return admin data

---

### 3️⃣ Create Logout Request

```
POST http://localhost:8000/api/v1/admin/logout

Headers:
  Authorization: Bearer YOUR_TOKEN_HERE
```

Click **Send** → Token is revoked

---

## Files to Read

1. **POSTMAN_QUICK_REFERENCE.md** - 1-page quick guide (copy-paste ready)
2. **POSTMAN_TESTING_GUIDE.md** - Detailed step-by-step instructions
3. **MOBILE_ADMIN_LOGIN_SETUP.md** - Complete setup guide

---

## Key Points ⚠️

✅ **Always use**: `Authorization: Bearer {token}` (with space)
❌ **Never use**: `Authorization: {token}` (missing Bearer)
❌ **Never use**: `AuthorizationBearer {token}` (no space)

---

## Token from Login Response

Look for this in the response:

```json
{
    "success": true,
    "data": {
        "token": "1|abc123xyz456def789ghi..."
    }
}
```

Copy the **entire string** starting with "1|"

---

## Before Testing

Make sure:

-   [ ] Laravel is running: `php artisan serve`
-   [ ] Admin account exists in database
-   [ ] Postman is installed
-   [ ] localhost:8000 is accessible

---

## Test Results

| Test                 | Expected         | Got |
| -------------------- | ---------------- | --- |
| Login                | 200 OK + token   | ✅  |
| Profile              | 200 OK + data    | ✅  |
| Logout               | 200 OK           | ✅  |
| Profile after logout | 401 Unauthorized | ✅  |

---

**Start with POSTMAN_QUICK_REFERENCE.md for fastest setup!** 🚀
