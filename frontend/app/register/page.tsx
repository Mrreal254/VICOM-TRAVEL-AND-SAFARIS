import Link from "next/link";

export default function RegisterPage() {
  return (
    <main className="min-h-screen bg-slate-50 px-4 py-16">
      <div className="mx-auto max-w-md rounded-3xl bg-white p-8 shadow-xl">
        <Link href="/" className="font-black text-green-800">VICOM TRAVEL & SAFARIS</Link>
        <h1 className="mt-8 text-3xl font-black">Create your account</h1>
        <form className="mt-8 space-y-4">
          <div className="grid grid-cols-2 gap-3">
            <input className="w-full rounded-xl border border-slate-200 px-4 py-3" placeholder="First name" />
            <input className="w-full rounded-xl border border-slate-200 px-4 py-3" placeholder="Last name" />
          </div>
          <input className="w-full rounded-xl border border-slate-200 px-4 py-3" type="email" placeholder="Email address" />
          <input className="w-full rounded-xl border border-slate-200 px-4 py-3" placeholder="Phone" />
          <input className="w-full rounded-xl border border-slate-200 px-4 py-3" type="password" placeholder="Password" />
          <input className="w-full rounded-xl border border-slate-200 px-4 py-3" type="password" placeholder="Confirm password" />
          <button className="w-full rounded-xl bg-green-800 px-4 py-3 font-bold text-white">Create account</button>
        </form>
        <p className="mt-6 text-sm text-slate-600">Already registered? <Link className="font-bold text-green-800" href="/login">Sign in</Link></p>
      </div>
    </main>
  );
}
