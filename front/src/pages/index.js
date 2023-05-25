import Head from 'next/head'
import { useAuth } from '@/hooks/auth'
import ApplicationLogo from "@/components/ApplicationLogo";

export default function Home() {
    const { user } = useAuth({ middleware: 'guest' })

    return (
        <>
            <Head>
                <title>Laravel</title>
            </Head>

            <div className="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-center sm:pt-0">
                <div className="flex flex-col gap-6 w-2/6">
                    <div className="self-center">
                        <ApplicationLogo />
                    </div>
                    <div className="inline-flex rounded-md shadow-sm" role="group">
                        <a
                            className="flex-1 px-4 py-2 text-sm cursor-pointer text-center font-medium border rounded-l-lg focus:z-10 focus:ring-2 bg-primary border-gray-600 text-white hover:text-white hover:bg-primary-hover focus:ring-blue-500 focus:text-white"
                            href="/login"
                        >
                            <button type="button">
                                Entrar
                            </button>
                        </a>
                        <a
                            className="flex-1 px-4 py-2 text-sm cursor-pointer text-center font-medium border-t border-r focus:z-10 focus:ring-2 bg-primary border-gray-600 text-white hover:text-white hover:bg-primary-hover focus:ring-blue-500 focus:text-white"
                            href="/cadastro"
                        >
                            <button type="button">
                                Cadastro Usuario
                            </button>
                        </a>
                        <a
                            className="flex-1 px-4 py-2 text-sm cursor-pointer text-center font-medium rounded-r-lg focus:z-10 focus:ring-2 bg-primary border-gray-600 text-white hover:text-white hover:bg-primary-hover focus:ring-blue-500 focus:text-white"
                            href="/cadastro-empresa"
                        >
                            <button type="button">
                                Cadastro Empresa
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </>
    )
}
