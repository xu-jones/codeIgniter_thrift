
namespace php service.test

include "base.thrift"
include "test.thrift"

service testAPI
{
	/** 卡牌详情 */
	test.testResp testInfo(1: test.testReq req) throws (1: base.baseException err);
}

