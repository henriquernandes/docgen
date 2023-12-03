import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import {Head, router, useForm} from "@inertiajs/react";
import EditarModal from "./EditarModal.jsx";
import CriarModal from "./CriarModal.jsx";
import {useState, useRef} from "react";
import {toast} from 'react-toastify'

export default function Index({auth, projetos}) {

    const [isEditarModalOpen, setEditarModalOpen] = useState(false);
    const [isCriarModalOpen, setCriarModalOpen] = useState(false);
    const projetoRef = useRef(null)

    return (
        <AuthenticatedLayout user={auth}>
            <Head title="Projetos"/>
            <div className="flex flex-col items-center h-screen">
                {
                    auth.id === auth.empresa.usuario_id &&
                    <button className="m-4 px-4 py-2 hover:bg-green-800 bg-green-600  text-white rounded"
                            onClick={() => setCriarModalOpen(true)}>Criar Projeto
                    </button>
                }
                { projetos.length === 0 ? (
                    <div className="text-center mt-6 text-xl text-gray-600">
                        Não existem projetos cadastrados.
                    </div>
                ) : (
                    <table className="w-full border-collapse bg-white border border-gray-300 rounded-lg">
                        <thead className="bg-gray-200">
                        <tr>
                            <th className="px-6 py-4">Titulo</th>
                            <th className="px-6 py-4">URL</th>
                            <th className="px-6 py-4 w-24">Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        {
                            projetos.map((projeto) => {

                                const handleDelete = (e) => {
                                    e.preventDefault();
                                    router.delete(`/projetos/${projeto.id}`);

                                    toast.success('Projeto Excluido com Sucesso!')
                                };

                                return (
                                    <tr key={projeto.id}>
                                        <td className="py-2 px-4 border">{projeto.titulo}</td>
                                        <td className="py-2 px-4 border">{projeto.url_padrao}</td>
                                        <td className="py-2 px-4 border-b flex space-x-1">
                                            { auth.id === auth.empresa.usuario_id && (
                                                <>
                                                    <button
                                                        className="px-4 py-2 bg-indigo-600 hover:bg-indigo-800 text-white rounded"
                                                        onClick={() => {
                                                            projetoRef.current = projeto
                                                            setEditarModalOpen(true);
                                                        }}>Editar
                                                    </button>
                                                    <button className="px-4 py-2 bg-red-700 hover:bg-red-900 text-white rounded"
                                                            onClick={handleDelete}>Excluir
                                                    </button>
                                                </>
                                            )}
                                            <button
                                                className="px-4 py-2 hover:bg-sky-700 bg-sky-500 text-white rounded"
                                                onClick={() => router.visit(`dashboard/${projeto.id}`)}
                                                >Acessar
                                            </button>
                                            <button
                                            onClick={() => router.visit(`testes/${projeto.id}`, { method: 'post' })}
                                                className="px-4 py-2 hover:bg-purple-700 bg-purple-500 text-white rounded">Testar
                                            </button>
                                        </td>
                                    </tr>
                                );
                            })
                        }
                        </tbody>
                    </table>
                )}
                <EditarModal
                     isOpen={isEditarModalOpen}
                     onClose={() => setEditarModalOpen(false)}
                     projeto={projetoRef.current}
                />
                <CriarModal isOpen={isCriarModalOpen} onClose={() => setCriarModalOpen(false)}/>
            </div>
        </AuthenticatedLayout>
    );
}
