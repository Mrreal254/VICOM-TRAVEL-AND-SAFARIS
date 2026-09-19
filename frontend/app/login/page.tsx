import Link from "next/link";

export default function LoginPage() {
  return (
    <main className="min-h-screen bg-slate-50 px-4 py-16">
      <div className="mx-auto max-w-md rounded-3xl bg-white p-8 shadow-xl">
        <Link href="/" className="font-black text-green-800">VICOM TRAVEL & SAFARIS</Link>
        <h1 className="mt-8 text-3xl font-black">Welcome back</h1>
        <p className="mt-2 text-sm text-slate-600">Sign in to manage your trips and bookings.</p>
        <form className="mt-8 space-y-4">
          <input className="w-full rounded-xl border border-slate-200 px-4 py-3" type="email" placeholder="Email address" />
          <input className="w-full rounded-xl border border-slate-200 px-4 py-3" type="password" placeholder="Password" />
          <button className="w-full rounded-xl bg-green-800 px-4 py-3 font-bold text-white">Sign in</button>
        </form>
        <p className="mt-6 text-sm text-slate-600">New to VICOM? <Link className="font-bold text-green-800" href="/register">Create an account</Link></p>
      </div>
    </main>
  );
}
