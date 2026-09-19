# Database — Phase 1

## Tables

- users
- roles
- role_user
- customer_profiles
- suppliers
- supplier_users
- destinations
- media
- settings
- audit_logs
- personal_access_tokens (Laravel Sanctum)

## Security

Passport numbers are sensitive and must never be returned by public endpoints. Passwords are hashed. Tokens and secrets are not committed to source control.
