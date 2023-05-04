import Image from 'next/image'
import { Inter } from 'next/font/google'

const inter = Inter({ subsets: ['latin'] })

export default function Home() {
  return (
    <div
      className={`flex min-h-screen flex-col items-center justify-between p-24 ${inter.className}`}
    >
      <p className={`m-0 max-w-[30ch] text-sm opacity-50`}>
        首页
      </p>
    </div>
  )
}
