import type { Metadata } from "next";
import "./globals.css";

export const metadata: Metadata = {
  title: {
    default: "VICOM TRAVEL & SAFARIS | Discover Kenya. Experience Africa.",
    template: "%s | VICOM TRAVEL & SAFARIS",
  },
  description:
    "Explore Kenya with VICOM Travel & Safaris. Discover safaris, local experiences, beach holidays, stays and travel adventures across Kenya.",
  openGraph: {
    title: "VICOM TRAVEL & SAFARIS",
    description: "Discover Kenya. Experience Africa.",
    type: "website",
  },
};

export default function RootLayout({ children }: Readonly<{ children: React.ReactNode }>) {
  return (
    <html lang="en">
      <body>{children}</body>
    </html>
  );
}
