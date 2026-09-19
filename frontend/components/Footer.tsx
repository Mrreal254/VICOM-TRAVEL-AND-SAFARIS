export function Footer() {
  return (
    <footer className="bg-slate-950 py-14 text-white">
      <div className="container grid gap-10 md:grid-cols-4">
        <div>
          <h3 className="text-lg font-black">VICOM TRAVEL & SAFARIS</h3>
          <p className="mt-3 text-sm leading-6 text-slate-300">Discover Kenya. Experience Africa.</p>
        </div>
        <div>
          <h4 className="font-bold">Explore</h4>
          <p className="mt-3 text-sm text-slate-300">Safaris · Local Visits · Stays · Beach Holidays</p>
        </div>
        <div>
          <h4 className="font-bold">Partners</h4>
          <p className="mt-3 text-sm text-slate-300">List your property · Become a VICOM Partner</p>
        </div>
        <div>
          <h4 className="font-bold">Contact</h4>
          <p className="mt-3 text-sm text-slate-300">Mombasa, Kenya</p>
        </div>
      </div>
      <div className="container mt-10 border-t border-white/10 pt-6 text-xs text-slate-400">
        © {new Date().getFullYear()} VICOM TRAVEL & SAFARIS. All rights reserved.
      </div>
    </footer>
  );
}
