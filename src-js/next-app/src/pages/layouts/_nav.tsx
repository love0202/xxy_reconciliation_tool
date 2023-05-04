import Image from 'next/image'
import { Inter } from 'next/font/google'

const inter = Inter({ subsets: ['latin'] })

export default function Home() {
  return (
    <main
      className={`flex min-h-screen flex-col items-center justify-between p-24 ${inter.className}`}
    >
      <div className="mb-32 grid text-center lg:mb-0 lg:grid-cols-4 lg:text-left">
          <h2 className={`mb-3 text-2xl font-semibold`}>
            _nav
          </h2>
      </div>
    </main>
  )
}
