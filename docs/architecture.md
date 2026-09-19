# Architecture

VICOM TRAVEL & SAFARIS uses a separated frontend/API architecture.

## Frontend

Next.js App Router, React, TypeScript and Tailwind CSS.

## Backend

Laravel REST API under `/api/v1`.

API groups:

- `/auth`
- `/public`
- `/customer`
- `/admin`

## Database

PostgreSQL.

Core Phase 1 entities:

User → Roles
User → Customer Profile
User → Supplier Membership
Supplier → Supplier Membership
Destination → Media

## Future phases

Safaris, local visits, stays, booking calendars, activities, transfers, car hire, bookings, payments, commissions, reviews, coupons, messaging and B2B travel agents are intentionally outside Phase 1.
