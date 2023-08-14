import ApplicationLogo from "@/Components/ApplicationLogo";
import { Link, Head } from "@inertiajs/react";

export default function Welcome({ auth, laravelVersion, phpVersion }) {
    return (
        <div className="w-[100vw] h-[100vh]">
            <div className="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0">
                <div className="flex flex-col gap-6 w-2/6">
                    <div className="self-center">
                        <ApplicationLogo className="block h-20 w-auto" />
                    </div>
                    <div
                        className="inline-flex rounded-md shadow-sm"
                        role="group"
                    >
                        <a
                            className="flex-1 px-4 py-2 text-sm cursor-pointer text-center font-medium border rounded-l-lg focus:z-10 focus:ring-2 bg-primary border-gray-600 text-white hover:text-white hover:bg-primary-hover focus:ring-indigo-500 hover:bg-cyan-700 focus:text-white bg-blue-950"
                            href="/login"
                        >
                            <button type="button">Entrar</button>
                        </a>
                        <a
                            className="flex-1 px-4 py-2 text-sm cursor-pointer text-center font-medium border-t border-b focus:z-10 focus:ring-2 bg-primary border-gray-600 text-white hover:text-white hover:bg-primary-hover focus:ring-indigo-500 hover:bg-cyan-700 focus:text-white bg-blue-950"
                            href="/cadastro"
                        >
                            <button type="button">Cadastro Usuario</button>
                        </a>
                        <a
                            className="flex-1 px-4 py-2 text-sm cursor-pointer text-center font-medium rounded-r-lg  border-t border-r border-b border-l focus:z-10 focus:ring-2 bg-primary border-gray-600 text-white hover:text-white hover:bg-primary-hover focus:ring-indigo-500 hover:bg-cyan-700 focus:text-white bg-blue-950"
                            href="/cadastro-empresa"
                        >
                            <button type="button">Cadastro Empresa</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
}
