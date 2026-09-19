import Link from "next/link";

const links = [
  ["Safaris", "/safaris"],
  ["Local Visits", "/local-visits"],
  ["Stays", "/stays"],
  ["Beach Holidays", "/beach-holidays"],
  ["Activities", "/activities"],
  ["Custom Trip", "/custom-trip"],
];

export function Navbar() {
  return (
    <header className="sticky top-0 z-50 border-b border-black/5 bg-white/95 backdrop-blur">
      <div className="container flex h-18 items-center justify-between gap-5">
        <Link href="/" className="text-lg font-black tracking-tight text-green-800">
          VICOM <span className="text-slate-900">TRAVEL & SAFARIS</span>
        </Link>
        <nav className="hidden items-center gap-5 lg:flex">
          {links.map(([label, href]) => (
            <Link key={href} href={href} className="text-sm font-semibold text-slate-700 hover:text-green-800">
              {label}
            </Link>
          ))}
        </nav>
        <div className="flex items-center gap-2">
          <Link href="/login" className="hidden rounded-full px-4 py-2 text-sm font-semibold sm:block">
            Login
          </Link>
          <Link href="/custom-trip" className="rounded-full bg-green-800 px-4 py-2 text-sm font-bold text-white hover:bg-green-900">
            Book Now
          </Link>
        </div>
      </div>
    </header>
  );
}
