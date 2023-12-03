import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import {Head} from "@inertiajs/react";
import JSONModal from "@/Pages/Logs/JSONModal.jsx";
import {useState} from "react";
import { toast } from 'react-toastify'
import { useRef } from "react";
import methodColors from "@/utils/methodColors";

export default function Index({auth, logs}) {

    const [isJSONModalOpen, setJSONModalOpen] = useState(false);
    const jsonRef = useRef(null)

    return (
        <AuthenticatedLayout user={auth}>
            <Head title="Logs"/>
            <div className="flex flex-col items-center h-screen">
                <h1 className="text-5xl p-4">Logs</h1>
                { logs.length === 0 ? (
                    <div className="text-center mt-6 text-xl text-gray-600">
                        Não existem logs cadastrados.
                    </div>
                ) : (
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
                        {
                            logs.map((log) => {

                                const handleDelete = (e) => {
                                    e.preventDefault();
                                    router.delete(`/logs/${log.id}`);

                                    toast.success('Log Excluido com Sucesso!')
                                };

                                return (
                                    <tr key={log.id}>
                                        <td className="py-2 px-4 border">{new Date(log.created_at).toLocaleString('pt-BR')}</td>
                                        <td className="py-2 px-4 border">{log.rota.projeto.titulo}</td>
                                        <td className="py-2 px-4 border" style={{backgroundColor:methodColors(log.corpo_envio_resposta.metodo.metodo).background}}>{log.corpo_envio_resposta.metodo.metodo.toUpperCase()}</td>
                                        <td className="py-2 px-4 border">{log.rota.rota}</td>
                                        <td className={`py-2 px-4 border ${(log.corpo_envio_resposta.codigo_http  >= 200 &&  log.corpo_envio_resposta.codigo_http <= 300)? 'bg-green-200' : 'bg-red-200' }`}>{log.corpo_envio_resposta.codigo_http}</td>
                                        <td className="py-2 px-4 border w-2"><button className="px-4 py-2 hover:bg-sky-700 bg-sky-500 text-white rounded" onClick={() => {
                                            console.log(log.corpo_envio_resposta.corpo_json)
                                            jsonRef.current = log.corpo_envio_resposta.corpo_json
                                            setJSONModalOpen(true)}}>Ver</button></td>
                                    </tr>
                                );
                            })
                        }
                        </tbody>
                    </table>
                )}
            </div>
            <JSONModal isOpen={isJSONModalOpen} onClose={() => setJSONModalOpen(false)} json={jsonRef.current}/>
        </AuthenticatedLayout>
    );
}
