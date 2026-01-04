# Mobile Admin Login - Testing on Localhost

## Prerequisites

1. **Admin account must exist** in database
2. **Laravel server running**: `php artisan serve`
3. **Mobile app** connected to same network or using localhost:8000

---

## Test Steps

### Step 1: Check Admin Account Exists

```bash
php artisan tinker
```

Then in Tinker:

```php
use App\Models\Admin;
Admin::all(); // Should show admin accounts

# Or check specific
Admin::where('email', 'admin@example.com')->first();
```

If no admin exists, create one:

```php
Admin::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => bcrypt('password123'),
]);
exit
```

### Step 2: Test Login Endpoint

**Using cURL:**

```bash
curl -X POST http://localhost:8000/api/v1/admin/login \
  -H "Content-Type: application/json" \
  -d '{
    "email": "admin@example.com",
    "password": "password123"
  }'
```

**Expected Response:**

```json
{
  "success": true,
  "message": "Logged in successfully",
  "data": {
    "admin": { ... },
    "token": "1|abc123..."
  }
}
```

### Step 3: Copy Token and Test Profile

```bash
TOKEN="1|abc123..."  # Replace with actual token

curl http://localhost:8000/api/v1/admin/profile \
  -H "Authorization: Bearer $TOKEN"
```

**Expected Response:**

```json
{
  "success": true,
  "data": { ... }
}
```

---

## Mobile App Implementation

### React Native Example:

```javascript
import axios from "axios";
import AsyncStorage from "@react-native-async-storage/async-storage";

const API_URL = "http://localhost:8000";

// Login
const loginAdmin = async (email, password) => {
    try {
        const response = await axios.post(`${API_URL}/api/v1/admin/login`, {
            email,
            password,
        });

        if (response.data.success) {
            // Save token
            await AsyncStorage.setItem("adminToken", response.data.data.token);
            return response.data.data.admin;
        }
    } catch (error) {
        console.error("Login failed:", error.response?.data?.message);
        throw error;
    }
};

// Get Profile (authenticated)
const getAdminProfile = async () => {
    try {
        const token = await AsyncStorage.getItem("adminToken");

        const response = await axios.get(`${API_URL}/api/v1/admin/profile`, {
            headers: {
                Authorization: `Bearer ${token}`,
                "Content-Type": "application/json",
            },
        });

        return response.data.data;
    } catch (error) {
        console.error("Failed to fetch profile:", error);
        throw error;
    }
};

// Logout
const logoutAdmin = async () => {
    try {
        const token = await AsyncStorage.getItem("adminToken");

        await axios.post(
            `${API_URL}/api/v1/admin/logout`,
            {},
            {
                headers: { Authorization: `Bearer ${token}` },
            }
        );

        await AsyncStorage.removeItem("adminToken");
    } catch (error) {
        console.error("Logout failed:", error);
    }
};
```

### Flutter Example:

```dart
import 'package:http/http.dart' as http;
import 'package:flutter_secure_storage/flutter_secure_storage.dart';
import 'dart:convert';

const String apiUrl = 'http://localhost:8000';
final secureStorage = const FlutterSecureStorage();

// Login
Future<void> loginAdmin(String email, String password) async {
  try {
    final response = await http.post(
      Uri.parse('$apiUrl/api/v1/admin/login'),
      headers: {'Content-Type': 'application/json'},
      body: jsonEncode({
        'email': email,
        'password': password,
      }),
    );

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      if (data['success']) {
        await secureStorage.write(
          key: 'adminToken',
          value: data['data']['token'],
        );
        print('Logged in successfully');
      }
    } else {
      print('Login failed: ${response.body}');
    }
  } catch (e) {
    print('Error: $e');
  }
}

// Get Profile
Future<Map<String, dynamic>> getAdminProfile() async {
  try {
    final token = await secureStorage.read(key: 'adminToken');

    final response = await http.get(
      Uri.parse('$apiUrl/api/v1/admin/profile'),
      headers: {
        'Authorization': 'Bearer $token',
        'Content-Type': 'application/json',
      },
    );

    if (response.statusCode == 200) {
      final data = jsonDecode(response.body);
      return data['data'];
    }
  } catch (e) {
    print('Error: $e');
  }
  return {};
}

// Logout
Future<void> logoutAdmin() async {
  try {
    final token = await secureStorage.read(key: 'adminToken');

    await http.post(
      Uri.parse('$apiUrl/api/v1/admin/logout'),
      headers: {'Authorization': 'Bearer $token'},
    );

    await secureStorage.delete(key: 'adminToken');
    print('Logged out successfully');
  } catch (e) {
    print('Error: $e');
  }
}
```

---

## Troubleshooting

### "Invalid email or password"

1. Check admin account exists: `php artisan tinker` → `Admin::all()`
2. Verify email and password are correct
3. Create test admin if needed (see Step 1)

### "Unauthenticated" error

1. Token not included in header
2. Token format wrong - should be `Bearer {token}`
3. Token may be invalid/revoked

### Connection refused

1. Laravel server not running (`php artisan serve`)
2. Wrong URL/port
3. Firewall blocking port 8000

### CORS error

1. Check `config/cors.php` has `'supports_credentials' => true`
2. Verify `'allowed_origins' => ['*']`
3. Headers must include `Content-Type: application/json`

---

## Quick Checklist

-   [ ] Admin account exists
-   [ ] Laravel server is running
-   [ ] Login endpoint returns token
-   [ ] Token format is correct
-   [ ] Authorization header is set
-   [ ] Profile endpoint works with token
-   [ ] CORS is configured
-   [ ] Mobile app stores token securely
