import Link from "next/link";
export default function Account() {
  return <main className="container py-16"><Link href="/" className="font-bold text-green-800">← Home</Link><h1 className="mt-8 text-5xl font-black">My VICOM Account</h1><div className="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">{["Bookings","Upcoming Trips","Payments","Invoices","Saved Trips","Profile"].map(x=><div key={x} className="rounded-2xl border border-slate-200 p-6"><h2 className="font-black">{x}</h2><p className="mt-2 text-sm text-slate-500">Ready for the next implementation phase.</p></div>)}</div></main>;
}
