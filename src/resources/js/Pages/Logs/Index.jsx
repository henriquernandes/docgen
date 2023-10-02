import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import {Head} from "@inertiajs/react";
import JSONModal from "@/Pages/Logs/JSONModal.jsx";
import {useState} from "react";
import { toast } from 'react-toastify'

export default function Index({auth}) {

    const [isJSONModalOpen, setJSONModalOpen] = useState(false);

    return (
        <AuthenticatedLayout user={auth}>
            <Head title="Logs"/>
            <div className="flex flex-col items-center h-screen">
                <h1 className="text-5xl p-4">Logs</h1>
                <table className="w-full border-collapse bg-white border border-gray-300 rounded-lg">
                    <thead className="bg-gray-200">
                    <tr>
                        <th className="px-6 py-4">Data</th>
                        <th className="px-6 py-4">Projeto</th>
                        <th className="px-6 py-4">Tipo Rota</th>
                        <th className="px-8 py-4">Rota</th>
                        <th className="px-6 py-4">Retorno</th>
                        <th className="px-6 py-4">JSON</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td className="py-2 px-4 border">01/11/2023 13:34</td>
                        <td className="py-2 px-4 border">Projeto API Mercado</td>
                        <td className="py-2 px-4 border bg-purple-500">GET</td>
                        <td className="py-2 px-4 border">/produtos</td>
                        <td className="py-2 px-4 border bg-red-200">404: Not Found</td>
                        <td className="py-2 px-4 border w-2"><button className="px-4 py-2 hover:bg-sky-700 bg-sky-500 text-white rounded" onClick={() => {toast.error("Rota não encontrada")}}>Ver</button></td>
                    </tr>
                    <tr>
                        <td className="py-2 px-4 border">01/11/2023 13:34</td>
                        <td className="py-2 px-4 border">Projeto API Mercado</td>
                        <td className="py-2 px-4 border bg-sky-500">POST</td>
                        <td className="py-2 px-4 border">/produtos/id</td>
                        <td className="py-2 px-4 border bg-red-200">404: Not Found</td>
                        <td className="py-2 px-4 border w-2"><button className="px-4 py-2 hover:bg-sky-700 bg-sky-500 text-white rounded" onClick={() => {toast.error("Rota não encontrada")}}>Ver</button></td>
                    </tr>
                    <tr>
                        <td className="py-2 px-4 border">01/11/2023 13:35</td>
                        <td className="py-2 px-4 border">Projeto API Mercado</td>
                        <td className="py-2 px-4 border bg-indigo-600">PUT</td>
                        <td className="py-2 px-4 border">/produtos/id</td>
                        <td className="py-2 px-4 border bg-red-200">404: Not Found</td>
                        <td className="py-2 px-4 border w-2"><button className="px-4 py-2 hover:bg-sky-700 bg-sky-500 text-white rounded" onClick={() => {toast.error("Rota não encontrada")}}>Ver</button></td>
                    </tr>
                    <tr>
                        <td className="py-2 px-4 border">01/11/2023 13:36</td>
                        <td className="py-2 px-4 border">Projeto API Mercado</td>
                        <td className="py-2 px-4 border bg-amber-600">PATCH</td>
                        <td className="py-2 px-4 border">/produtos/id</td>
                        <td className="py-2 px-4 border bg-green-200">200: OK</td>
                        <td className="py-2 px-4 border w-2"><button className="px-4 py-2 hover:bg-sky-700 bg-sky-500 text-white rounded" onClick={() => {setJSONModalOpen(true);}}>Ver</button></td>
                    </tr>
                    <tr>
                        <td className="py-2 px-4 border">01/11/2023 13:37</td>
                        <td className="py-2 px-4 border">Projeto API Mercado</td>
                        <td className="py-2 px-4 border bg-red-700">DELETE</td>
                        <td className="py-2 px-4 border">/produtos/id</td>
                        <td className="py-2 px-4 border bg-green-200">200: OK</td>
                        <td className="py-2 px-4 border w-2"><button className="px-4 py-2 hover:bg-sky-700 bg-sky-500 text-white rounded" onClick={() => {setJSONModalOpen(true);}}>Ver</button></td>
                    </tr>
                    <tr>
                        <td className="py-2 px-4 border">01/11/2023 13:38</td>
                        <td className="py-2 px-4 border">Projeto API Mercado</td>
                        <td className="py-2 px-4 border bg-purple-500">GET</td>
                        <td className="py-2 px-4 border">/produtos?nome="computador"&id=1</td>
                        <td className="py-2 px-4 border bg-green-200">200: OK</td>
                        <td className="py-2 px-4 border w-2"><button className="px-4 py-2 hover:bg-sky-700 bg-sky-500 text-white rounded" onClick={() => {setJSONModalOpen(true);}}>Ver</button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <JSONModal isOpen={isJSONModalOpen} onClose={() => setJSONModalOpen(false)}/>
        </AuthenticatedLayout>
    );
}
