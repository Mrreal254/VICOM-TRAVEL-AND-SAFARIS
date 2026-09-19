import Link from "next/link";
import { Navbar } from "@/components/Navbar";
import { Footer } from "@/components/Footer";

const destinations = ["Tsavo East", "Amboseli", "Maasai Mara", "Mombasa", "Diani", "Watamu"];

export default function Home() {
  return (
    <>
      <Navbar />
      <main>
        <section className="relative overflow-hidden bg-slate-950 text-white">
          <div className="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1516426122078-c23e76319801?auto=format&fit=crop&w=2200&q=80')] bg-cover bg-center opacity-60" />
          <div className="relative container flex min-h-[620px] items-center py-24">
            <div className="max-w-3xl">
              <p className="mb-5 text-sm font-bold uppercase tracking-[0.25em] text-emerald-300">VICOM TRAVEL & SAFARIS</p>
              <h1 className="text-5xl font-black tracking-tight sm:text-7xl">Discover Kenya.</h1>
              <p className="mt-5 max-w-2xl text-xl leading-8 text-slate-100">
                Safaris, local adventures, beach holidays & beautiful places to stay.
              </p>
              <div className="mt-8 flex flex-wrap gap-3">
                <Link href="/safaris" className="rounded-full bg-green-700 px-6 py-3 font-bold hover:bg-green-800">Explore Trips</Link>
                <Link href="/stays" className="rounded-full bg-white px-6 py-3 font-bold text-slate-900 hover:bg-slate-100">Find a Stay</Link>
                <Link href="/custom-trip" className="rounded-full border border-white/40 px-6 py-3 font-bold hover:bg-white/10">Plan My Trip</Link>
              </div>
            </div>
          </div>
        </section>

        <section className="relative -mt-10">
          <div className="container">
            <div className="rounded-3xl bg-white p-5 shadow-2xl ring-1 ring-black/5">
              <div className="grid gap-3 md:grid-cols-5">
                <input className="rounded-xl border border-slate-200 px-4 py-3" placeholder="Where are you going?" />
                <input className="rounded-xl border border-slate-200 px-4 py-3" type="date" />
                <input className="rounded-xl border border-slate-200 px-4 py-3" type="date" />
                <input className="rounded-xl border border-slate-200 px-4 py-3" placeholder="Guests" />
                <button className="rounded-xl bg-green-800 px-5 py-3 font-bold text-white">Search</button>
              </div>
            </div>
          </div>
        </section>

        <section className="container py-20">
          <div className="flex items-end justify-between gap-5">
            <div>
              <p className="text-sm font-bold uppercase tracking-widest text-green-700">Start exploring</p>
              <h2 className="mt-2 text-3xl font-black sm:text-4xl">Popular Kenya destinations</h2>
            </div>
            <Link href="/local-visits" className="text-sm font-bold text-green-800">Explore all →</Link>
          </div>
          <div className="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            {destinations.map((name) => (
              <article key={name} className="group overflow-hidden rounded-3xl bg-slate-100">
                <div className="h-64 bg-[url('https://images.unsplash.com/photo-1547471080-7cc2caa01a7e?auto=format&fit=crop&w=1200&q=80')] bg-cover bg-center transition duration-500 group-hover:scale-105" />
                <div className="bg-white p-5">
                  <h3 className="text-xl font-black">{name}</h3>
                  <p className="mt-2 text-sm text-slate-600">Discover experiences with VICOM Travel & Safaris.</p>
                </div>
              </article>
            ))}
          </div>
        </section>

        <section className="bg-[var(--vicom-sand)] py-20">
          <div className="container grid gap-10 lg:grid-cols-2 lg:items-center">
            <div>
              <p className="text-sm font-bold uppercase tracking-widest text-green-700">Why VICOM</p>
              <h2 className="mt-2 text-4xl font-black">One place to plan your Kenya journey.</h2>
              <p className="mt-5 leading-7 text-slate-700">From safari and beach escapes to stays, activities and custom itineraries, VICOM is being built as a single travel marketplace for Kenya.</p>
            </div>
            <div className="grid gap-4 sm:grid-cols-2">
              {["Local expertise", "Verified partners", "Flexible travel", "Human support"].map((item) => (
                <div key={item} className="rounded-2xl bg-white p-6 shadow-sm">
                  <div className="text-2xl">✦</div>
                  <h3 className="mt-3 font-black">{item}</h3>
                </div>
              ))}
            </div>
          </div>
        </section>

        <section className="container py-20 text-center">
          <p className="text-sm font-bold uppercase tracking-widest text-green-700">Ready when you are</p>
          <h2 className="mt-2 text-4xl font-black">Plan your next Kenyan adventure.</h2>
          <Link href="/custom-trip" className="mt-7 inline-flex rounded-full bg-green-800 px-7 py-3 font-bold text-white">Plan My Trip</Link>
        </section>
      </main>
      <Footer />
    </>
  );
}
